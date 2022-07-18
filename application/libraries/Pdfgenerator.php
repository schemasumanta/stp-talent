<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once dirname(__FILE__).'/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Pdfgenerator {

  public function generate($html, $filename='', $stream=TRUE, $paper = 'A3', $orientation = "landscape")
  {
    $dompdf = new DOMPDF();
    $dompdf->loadHtml($html);
    $dompdf->setPaper($paper, $orientation);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf", array("Attachment" =>1));
    } else {
        return $dompdf->output();
    }
  }

  public function generate_view($html, $filename='', $stream=TRUE, $paper = 'A3', $orientation = "landscape")
  {
    $dompdf = new DOMPDF();
    $dompdf->loadHtml($html);
    $dompdf->setPaper($paper, $orientation);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf", array("Attachment" =>0));
    } else {
        return $dompdf->output();
    }
  }
}