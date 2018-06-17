<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IngestionDataController extends Controller
{
    /**
     * @Route("/ingestion/data", name="ingestion_data")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/IngestionDataController.php',
        ]);
    }
}
