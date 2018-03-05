<?php
require('../../includes/fpdf/fpdf.php');
class PDF extends FPDF {

// Cargar los datos
    function LoadData($file) {
        // Leer las líneas del fichero
        $lines = file($file);
        $data = array();
        foreach ($lines as $line)
            $data[] = explode(';', trim($line));
        return $data;
    }


// Tabla coloreada
    function FancyTable($header, $data) {
        // Colores, ancho de línea y fuente en negrita
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        // Cabecera
        $w = [];
        foreach($header as $h){
            array_push($w,20);
        }
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 5, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        // Restauración de colores y fuentes
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Datos
        $fill = false;
        foreach ($data as $row) {
            foreach($row as $r){
                $this->Cell($w[0], 6, $r, 'LR', 0, 'L', $fill);
            }

            $this->Ln();
            $fill = !$fill;
        }
        // Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    public function extraerFicheroPDF($columns, $data,$titulo=''){
        // Títulos de las columnas
        $header = $columns;
        // Carga de datos
        $this->SetFont('Arial', '', 20);
        $this->SetTitle($titulo);
        $this->AddPage('L');
        $this->Cell(0,10,$titulo,0,0,'C');
        $this->Ln(15);
        $this->SetFont('Arial', '', 7);
        $this->FancyTable($header, $data);
        $this->Output();
        header("Content-type:application/pdf");
        // It will be called downloaded.pdf
        header("Content-Disposition:attachment;filename='downloaded.pdf'");
        // The PDF source is in original.pdf
        readfile("informe.pdf");
    }
}


?>