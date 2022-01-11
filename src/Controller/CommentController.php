<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Episode;
use App\Form\CommentType;
use App\Form\EpisodeType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Service\Slugify;


class CommentController extends AbstractController
{
    /**
     * @route("/{slug}/new-comment", name="form_comment")
     */
    public function newComment(Episode $episode, Request $request, ManagerRegistry $managerRegistry): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setEpisode($episode);
            $comment->setAuthor($this->getUser());
            $managerRegistry->getManager()->persist($comment);
            $managerRegistry->getManager()->flush();

            return $this->redirectToRoute('episode_index');

        }

        return $this->render('episode/commentEpisode.html.twig', [
            "form" => $form->createView(),
        ]);
    }
    /**
     * @Route("/{slug}/comment/edit", name="edit_comment")
     */
    public function editComment(Episode $episode,Comment $comment, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('episode_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('episode/editCommentEpisode.html.twig', [
            'episode' => $episode,
            'form' => $form->createView(),
        ]);
    }
}