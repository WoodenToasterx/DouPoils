<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

require('PDO.php');

class MenuItemController extends AbstractController
{
    /**
     * @Route("/menu")
     */

    use PDO;
    public function menu()
    {
        $pdo = PDO::getInstance();
        $req = $pdo->prepare("SELECT * FROM doupoils.animal");
        
        $req->execute();
        $array = $req->fetch($pdo::FETCH_ASSOC);
		return $this->render('menu.html.twig', ['animals' => $array,]); 
	}
}
?>