<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontEnd extends Controller {

    /**
     * @Route("/")
     */
    public function index() {

        header("Location: http://localhost:8000/front_end/index.html", true);
        exit();
    }

}
