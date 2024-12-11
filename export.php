<?php
// Include the main TCPDF library
require_once('tcpdf/tcpdf.php');
include 'database.php';

// Create new PDF document
class MYPDF extends TCPDF {
    // Page header
    public function Header() {
        // Set font
        $this->SetFont('helvetica', 'B', 16);
        // Title
        $this->Cell(0, 15, 'Daftar Pendaftar', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Halaman '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// Create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Daftar Pendaftar');
$pdf->SetSubject('Daftar Siswa');

// Set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Add a page
$pdf->AddPage('L'); // Landscape orientation

// Set font
$pdf->SetFont('helvetica', '', 10);

// Create table header
$html = '<table border="1" cellpadding="4">';
$html .= '<thead>';
$html .= '<tr style="background-color:#df6cbe; color:white;">';
$html .= '<th>Nama</th><th>Jenis Kelamin</th><th>Email</th><th>Pegawai</th><th>Foto</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

// Fetch data
$query = "SELECT siswa.*, pegawai.nama as nama_pegawai, pegawai.jabatan 
          FROM siswa 
          JOIN pegawai ON siswa.id_pegawai = pegawai.id_pegawai";
$result = mysqli_query($koneksi, $query);

// Add rows to table
while($siswa = mysqli_fetch_assoc($result)) {
    // Prepare image path
    $image_path = 'upload/' . $siswa['foto'];
    
    $html .= '<tr>';
    $html .= '<td>' . htmlspecialchars($siswa['nama_siswa']) . '</td>';
    $html .= '<td>' . ($siswa['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan') . '</td>';
    $html .= '<td>' . htmlspecialchars($siswa['email']) . '</td>';
    $html .= '<td>' . htmlspecialchars($siswa['nama_pegawai'] . ' (' . $siswa['jabatan'] . ')') . '</td>';
    
    // Add image to PDF
    if (file_exists($image_path)) {
        $html .= '<td><img src="' . $image_path . '" width="100" height="auto"></td>';
    } else {
        $html .= '<td>Foto tidak tersedia</td>';
    }
    
    $html .= '</tr>';
}

$html .= '</tbody>';
$html .= '</table>';

// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('daftar_siswa.pdf', 'I');
?>