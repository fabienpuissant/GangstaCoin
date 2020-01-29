<?php

namespace App\Controller;

use App\Form\SignInType;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;

    }


    /**
     * @Route("/register", name = "register", methods="GET|POST")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request) 
    {
        $user = new User();
        $form = $this->createForm(SignInType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            if($this->repository->checkValidEmail($data->getEmail()) 
            && $this->repository->checkValidMdp($data->getMdp()) 
            && $this->repository->checkValidUsername($data->getUsername()))
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($data);
                $em->flush(); 
                return $this->redirection($form, 0);
            }
            return $this->redirection($form, 1);
        }
        return $this->redirection($form, 2);
    }

    /**
     * @param SignInType 
     * @param Integer Error to display 0 no error, 1 error
     */
    private function redirection($form, $err){
        return $this->render('pages/register.html.twig', [
            'form' => $form->createView(),
            'err' => $err
        ]);
    }
}