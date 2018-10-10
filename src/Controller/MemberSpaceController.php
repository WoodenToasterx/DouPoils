<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

class MemberSpaceController extends AbstractController
{
    /**
     * @Route("/memberSpace")
     */

    public function memberSpace()
    {

        echo $this->get('session')->get('name');
        return $this->render('member_space.html.twig');
	}
}
?>