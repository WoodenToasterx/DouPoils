<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MemberSpaceController extends AbstractController
{
    /**
     * @Route("/memberSpace")
     */

    public function memberSpace()
    {
        return $this->render('member_space.html.twig');
	}
}
?>