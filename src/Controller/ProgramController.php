<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\ProgramType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/program", name="program_")
 */
class ProgramController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        return $this->render(
            'program/index.html.twig',
            ['programs' => $programs,]);
    }

    /**
     * @Route("/new", name="new")
     */
    public function new(Request $request): Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManger = $this->getDoctrine()->getManager();
            $entityManger->persist($program);
            $entityManger->flush();
            return $this->redirectToRoute('program_index');
        }
        return $this->render('program/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     * @return Response
     */
    public function show(Program $program): Response
    {
        $season = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findBy(['program' => $program]);

        return $this->render('program/show.html.twig', [
            'program' => $program,
            'season' => $season
        ]);
    }

    /**
     * @Route("/{program_id}/season/{season_id}", name="season_show")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program_id": "id"}})
     * @ParamConverter("season", class="App\Entity\Season", options={"mapping": {"season_id": "id"}})
     * @return Response
     */
    public function showSeason(Program $program, Season $season): Response
    {
        $episode = $this->getDoctrine()
            ->getRepository(Episode::class)
            ->findBy(['season' => $season]);


        return $this->render('program/season_show.html.twig', [
            'episode' => $episode,
            'program' => $program,
            'season' => $season
        ]);
    }

    /**
     * @Route("/{program_id}/season/{season_id}/episode/{episode_id}", name="episode_show")
     * @ParamConverter("program", class="App\Entity\Program", options={"mapping": {"program_id": "id"}})
     * @ParamConverter("season", class="App\Entity\Season", options={"mapping": {"season_id": "id"}})
     * @ParamConverter("episode", class="App\Entity\Episode", options={"mapping": {"episode_id": "id"}})
     * @return Response
     */
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
        return $this->render('program/episode_show.html.twig', [
            'episode' => $episode,
            'program' => $program,
            'season' => $season
        ]);
    }
}
