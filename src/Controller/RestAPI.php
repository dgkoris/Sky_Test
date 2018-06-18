<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\IngestionData;

class RestAPI extends Controller {

    private function format_data(IngestionData $ingestion_data) {

        $data = array(
            'timestamp' => $ingestion_data->getTimestamp(),
            'cpu_load' => $ingestion_data->getCpuLoad(),
            'concurrency' => $ingestion_data->getConcurrency(),
        );

        return $data;
    }

    /**
     * @Route("/show/{id}")
     */
    public function show(IngestionData $ingestion_data = null) {

        if (!$ingestion_data) {
            return new Response(json_encode(array()));
        }

        $result[] = self::format_data($ingestion_data);

        return new Response(json_encode($result));
    }

    /**
     * @Route("/show/after/{timestamp}")
     */
    public function show_after($timestamp) {

        $data = $this->getDoctrine()
                ->getRepository(IngestionData::class)
                ->findAllGreaterThan($timestamp);

        if (!$data) {
            return new Response(json_encode(array()));
        }

        $result = array();
        foreach ($data as $ingestion_data) {
            $result[] = self::format_data($ingestion_data);
        }

        return new Response(json_encode($result));
    }

    /**
     * @Route("/show/before/{timestamp}")
     */
    public function show_before($timestamp) {

        $data = $this->getDoctrine()
                ->getRepository(IngestionData::class)
                ->findAllLessThan($timestamp);

        if (!$data) {
            return new Response(json_encode(array()));
        }

        $result = array();
        foreach ($data as $ingestion_data) {
            $result[] = self::format_data($ingestion_data);
        }

        return new Response(json_encode($result));
    }

    /**
     * @Route("/show/between/{from_timestamp}/{to_timestamp}")
     */
    public function show_between($from_timestamp, $to_timestamp) {

        $data = $this->getDoctrine()
                ->getRepository(IngestionData::class)
                ->findAllBetween($from_timestamp, $to_timestamp);

        if (!$data) {
            return new Response(json_encode(array()));
        }

        $result = array();
        foreach ($data as $ingestion_data) {
            $result[] = self::format_data($ingestion_data);
        }

        return new Response(json_encode($result));
    }

}
