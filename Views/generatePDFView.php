<?php
//AddPage(orientation[PORTRAIT, LADSCAPE], tamaño [A3, A4, A5, LETTER, LEGAL]),
//SetFont[tipo(COURIER, HELVETICA, ARIAL, TIMES, SYMBOL, ZAPDINGBATS), estilo[normal, B, I, U], tamaño],
//Cell(ancho, alto, texto, bordes, ?, alineación, rellenar, link)
//OutPut(destino[I, D, F, S], nombre_archivo, utf-8)
require('pdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(40,40,40);
$pdf->SetAutoPageBreak(true);
$pdf->Image($enterprise->getImagePath(),null,null,120,120);
$pdf->Ln();
$pdf->Cell(65,20,'Nombre de la empresa: '.$jobOfferDTO->getEnterpriseName(),0,0,'C');
$pdf->Ln();
$pdf->Cell(120,20,'Nombre de la carrera: '.$jobOfferDTO->getCareerName(),0,0,'C');
$pdf->Ln();
$pdf->Cell(100,20, 'Fecha inicial: '. $jobOfferDTO->getStartDate().'. Fecha limite: '.$jobOfferDTO->getLimitDate(),0,0,'C');
$pdf->Ln();
$pdf->Cell(100,20,'Descripcion de la oferta:');
$pdf->Ln();
$pdf->Cell(100,20,'Salario: $'.$jobOfferDTO->getSalary());

$pdf->AddPage();
$pdf->Cell(190,20,'Listado de los alumnos que se postulan a la oferta laboral:',0,0,'C');
$pdf->Ln();
$pdf->Cell(40,10,'Numero',0,0,'C');
$pdf->Cell(40,10,'Nombre',0,0,'C');
$pdf->Cell(40,10,'Email',0,0,'C');
$pdf->Cell(40,10,'Telefono',0,0,'C');
$pdf->Ln();
$i=1;
foreach ($studentList as $student){

    $pdf->Cell(40,10,$i,0,0,'C');
    $pdf->Cell(40,10,$student->getStudentName(),0,0,'C');
    $pdf->Cell(40,10,$student->getStudentEmail(),0,0,'C');
    $pdf->Cell(40,10,$student->getStudentPhone(),0,0,'C');
    $pdf->Ln();
    $i++;
}

$pdf->Output(null,null,true);
?>