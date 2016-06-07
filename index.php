<?php

require_once './public/bootstrap.php';

use Frisdrank\Business\DrankService;
use Frisdrank\Business\WisselgeldService;

//use Frisdrank\Entities\Wisselgeld;

$drankService = new DrankService();
$wisselgeldService = new WisselgeldService();

$drankenLijst = $drankService->getAll();

if (isset($_SESSION['display'])) {
    $display = $_SESSION['display'];
} else {
    $display = "Druk op een knop hierboven om een muntje in te werpen.";
}

if (isset($_SESSION['input'])) {
    $input = $_SESSION['input'];
} else {
    $input = "";
}


if (isset($_GET["action"]) && $_GET["action"] == 'push') {

    $muntjesInvoer = array();

    if (!isset($_SESSION['display'])) {
		
        $display = "";
    }

    if (isset($_POST["invoer"])) {

        $display .= "\r\nmunt invoer " . $_POST["invoer"] . ".";
        $_SESSION['display'] = $display;

        $wisselgeld = $wisselgeldService->getByName($_POST["invoer"]);
        $waarde = $wisselgeld->getWaarde();

        /* ingevoerde muntjes in de db */
        $wisselgeldService->increaseWithOne($wisselgeld);

        $input = $input + $wisselgeld->getWaarde();
        $_SESSION['input'] = $input;
        $display .= "\r\n\r\nIngevoerd bedrag: € " . $input . ".";
    }

    if (isset($_POST["dranken"])) {

        if ($_SESSION['input'] && $_SESSION['input'] > 0) {

            $display .= "\r\n\r\nIngevoerd bedrag: € " . $_SESSION['input'] . ".";
        }


        $drank = $drankService->getById($_POST["dranken"]);

        if ($drank->getPrijs() > $_SESSION['input']) {

            $display .= "\r\nDe prijs van uw keuze bedraagt € " . $drank->getPrijs() . ".";
        } else {

            $display .= "\r\nDe prijs van uw keuze bedraagt € " . $drank->getPrijs() . ".";

            unset($_SESSION['display']);

            $terug = (float) $_SESSION['input'] - $drank->getPrijs();

            /* drankvoorraad aanpassen */
            $drankService->decreaseDrankVoorraadByOne($drank);

            if ($terug > 0) {

                $display .= "\r\n\r\nU krijgt € $terug verdeeld als ";

                /* muntjes berekenen om terug te geven */
                $lijstMuntjes = $wisselgeldService->getMuntjes($terug);

                /* terug te geven muntjes tonen */
                foreach ($lijstMuntjes as $key => $value) {
                    if ($value > 1) {

                        $display .= "\r\n " . $value . " muntjes van " . $key . ' €';
                    } else {

                        $display .= "\r\n " . $value . " muntje van " . $key . ' €';
                    }
                }
                $display .="\r\nterug.";

                /* db aanpassen met de terug te geven muntjes */
                $wisselgeldService->decreaseWithChange($lijstMuntjes);
				
            } elseif ($terug == 0) {
				
                $display .= "\r\n\r\nU heeft gepast betaald.";
            }
			
            $display .= "\r\n\r\nUw drankje is nu beschikbaar.";
			$display .= "\r\n\r\nDruk op een knop hierboven om een muntje in te werpen.";
			
            unset($_SESSION['input']);
			
            $muntjesInvoer = "";
        }
    }
}

print($twig->render("home.twig", array(
            'display' => $display,
            'drankenLijst' => $drankenLijst
)));
