<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Constants;
use App\Entity\IngestionData;

class IngestionLayer extends Controller {

    private function get_ingestion_data($time) {

        return array(
            'timestamp' => $time,
            'cpu_load' => rand(0, 100),
            'concurrency' => random_int(0, 500000)
        );
    }

    private function set_ingestion_data(array $data) {

        $entityManager = $this->getDoctrine()->getManager();

        foreach ($data as $value) {

            $ingestion_data = new IngestionData();
            $ingestion_data->setTimestamp($value['timestamp']);
            $ingestion_data->setCpuLoad($value['cpu_load']);
            $ingestion_data->setConcurrency($value['concurrency']);

            $entityManager->persist($ingestion_data);
        }

        $entityManager->flush();

        return json_encode($data);
    }

    /**
     * @Route("/ingest/{minutes}")
     */
    public function ingest($minutes = 5) {

        $time = time();
        $time -= $minutes * Constants::MINUTE_SECONDS;

        $data = array();
        $total = $minutes + 1;
        for ($i = 0; $i < $total; $i++) {
            $data[] = self::get_ingestion_data($time);
            $time += Constants::MINUTE_SECONDS;
        }

        $json = self::set_ingestion_data($data);

        return new Response(
                $json
        );
    }

    /**
     * @Route("/ingest_realtime/{minutes}")
     */
    public function ingest_realtime($minutes = 5) {

        $default_max_time = ini_get('max_execution_time');
        set_time_limit($default_max_time + $minutes * Constants::MINUTE_SECONDS);
        // echo ini_get('max_execution_time') . '<br>';

        $data = array();
        $total = $minutes + 1;
        for ($i = 0; $i < $total; $i++) {
            $time = time();
            $data[] = self::get_ingestion_data($time);
            if ($i < $minutes) {
                sleep(Constants::MINUTE_SECONDS);
            }
        }

        set_time_limit($default_max_time);
        // echo ini_get('max_execution_time') . '<br>';

        $json = self::set_ingestion_data($data);

        return new Response(
                $json
        );
    }

}
