<?php

namespace App\Controller;

use App\Entity\Human;
use App\Form\HumanType;
use App\Repository\HumanRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class HumanController extends AbstractController
{

    public function __construct(
        private HumanRepository $humanRepository,
        private EntityManagerInterface $entityManager,
    ) {
    }


    #[Route('/',name: 'app_human')]
    public function index(): Response
    {

        $humanList = $this->humanRepository->findAll();

        return $this->render('human/index.html.twig', [
            'humans' => $humanList,
        ]);
    }

    #[Route('/show/{id}', name: 'app_human_show')]
    public function detail($id): Response
    {

        $humanEntity = $this->humanRepository->find($id);

        if ($humanEntity === null) {
            return $this->redirectToRoute('app_human');
        }

        return $this->render('human/show.html.twig', [
            'human' => $humanEntity
        ]);
    }

    #[Route('/add', name: 'app_human_add')]
    public function add(Request $request): Response
    {
        $human = new Human();
        $form = $this->createForm(HumanType::class, $human);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($human);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_human');
        }

        return $this->render('human/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
