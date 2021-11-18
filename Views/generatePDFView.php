<?php
require('pdf/fpdf.php');
$pdf = new FPDF();
$pdf->SetFont('Arial', '', 12);
$pdf->AddPage();
$header = array('Nombre', 'email', 'Telefono', 'Presentacion');
/* Header */
foreach ($header as $col) {
    $pdf->Cell(38, 7, $col, 1);
    $pdf->Ln();
}
/* Data */
foreach ($data as $row) {
    foreach ($row as $col) {
        $pdf->Cell(38, 6, $col, 1);
    }
    $pdf->Ln();
}
$pdf->Output();
?>