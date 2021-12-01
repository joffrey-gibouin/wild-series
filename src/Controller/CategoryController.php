<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Program;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category", name="category_")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findBy(array());
        return $this->render(
            'category/index.html.twig',
            ['categories' => $categories,]
        );
    }

    /**
     * @param string $categoryName
     * @Route("/{categoryName}", name="show")
     * @return Response
     */
    public function show(string $categoryName): Response
    {
        $categoryName = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $categoryName]);

        if (!$categoryName) {
            throw $this->createNotFoundException(
                'No category with name : ' .$categoryName. 'found in category\'s table.'
            );
        }

        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(['category' => $categoryName],
                ['id' => 'DESC'],
                3);

        return $this->render('category/show.html.twig', [
            'categoryName' => $categoryName,
            'programs' => $programs,
        ]);
    }
}