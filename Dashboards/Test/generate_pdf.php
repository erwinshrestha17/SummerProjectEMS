<?php

require_once('path/to/tcpdf/tcpdf.php');

class PdfGenerator {

    private $pdf;

    public function __construct() {
        $this->pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $this->setDocumentInfo();
    }

    public function setDocumentInfo() {
        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('Your Name');
        $this->pdf->SetTitle('Invoice PDF');
    }

    public function generatePdfDocument() {
        $this->pdf->AddPage();
        $html = $this->generateHtmlContent();
        $this->pdf->writeHTML($html, true, false, true, false, '');
        $this->pdf->Output('invoice.pdf', 'I');
        exit;
    }

    public function generateHtmlContent() {
        $html = '<h1>Invoice</h1>';
        $html .= '<p>Invoice details go here.</p>';

        return $html;
    }
}

// Example usage
$pdfGenerator = new PdfGenerator();
$pdfGenerator->generatePdfDocument();

?>