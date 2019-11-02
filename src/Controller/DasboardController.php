<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DasboardController extends AbstractController
{
    /**
     * @Route("/", name="dasboard", methods={"GET"})
     */
    public function index()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        $cpu = $this->get_server_cpu_usage();
        return $this->render('dasboard/index.html.twig', [
            'cpu' => $cpu,
            'titre' => "Tableau de Board",
            'bande' => "Dasboard"
        ]);
    }

    function get_server_cpu_usage()
    {
        $load = null;
        if (stristr(PHP_OS, "win")) {
            $cmd = "wmic cpu get loadpercentage /all ";
            @exec($cmd, $output);
            if ($output) {
                foreach ($output as $line)
                {
                    if ($line && preg_match("/^[0-9]+\$/", $line))
                    {
                        $load = $line;
                        break;
                    }
                }
            }
        } else {
            $sys_load = sys_getloadavg();
            $load = $sys_load[0];
        }
        return (int) $load;
    }

}
