<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     *  @Route("/login", name = "login" methods="GET|POST")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login() {
        return $this->render('login.html.twig');
    }
}