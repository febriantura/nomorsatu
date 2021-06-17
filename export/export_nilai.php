<?php
include "../koneksi.php";
if (isset($_POST['export'])) {
    $idmemo = $_POST['idmemo'];  
    $mm = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM mm_memo WHERE id_memo = '$idmemo'"));

    require_once 'PHPExcel/PHPExcel.php';

// Panggil class PHPExcel nya
$excel = new PHPExcel();

// Settingan awal fil excel
$excel->getProperties()->setCreator('Restu Febriantura')
					   ->setLastModifiedBy('Restu Febriantura')
					   ->setTitle("NILAI PROFESI")
					   ->setSubject("FKUMS")
					   ->setDescription("nilai koas")
					   ->setKeywords("nilai koas");

// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$style_col = array(
	'font' => array('bold' => true), // Set font nya jadi bold
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	),
	'borders' => array(
		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	)
);

$style_coln = array(
	'alignment' => array(
		'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	),
	'borders' => array(
		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	)
);

// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$style_row = array(
	'alignment' => array(
		'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	),
	'borders' => array(
		'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
		'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
		'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
		'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
	)
);

$excel->setActiveSheetIndex(0)->setCellValue('A1', "NILAI KOAS FK UMS"); // Set kolom A1 dengan tulisan "DATA SISWA"
//$excel->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
//$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
// Buat header tabel nya pada baris ke 3
$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
$excel->setActiveSheetIndex(0)->setCellValue('B3', "RUMAH SAKIT"); // Set kolom B3 dengan tulisan "NIS"
$excel->setActiveSheetIndex(0)->setCellValue('C3', "STASE"); // Set kolom C3 dengan tulisan "NAMA"
$excel->setActiveSheetIndex(0)->setCellValue('D3', "NIM"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
$excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA"); // Set kolom E3 dengan tulisan "TELEPON"

$mulai = 'F';
$q_ujian = mysqli_query($koneksi, "SELECT * FROM ipt_ujian");
while ($d_ujian = mysqli_fetch_array($q_ujian)){
  $excel->setActiveSheetIndex(0)->setCellValue($mulai.'3', $d_ujian['alias_ujian']);
  $mulai = chr(ord($mulai) + 1);
}

// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);

$mulai_ = 'F';
$q_ujian = mysqli_query($koneksi, "SELECT * FROM ipt_ujian");
while ($d_ujian = mysqli_fetch_array($q_ujian)){
	$excel->getActiveSheet()->getStyle($mulai_.'3')->applyFromArray($style_col);
  $mulai_ = chr(ord($mulai_) + 1);
}

// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

// Buat query untuk menampilkan semua data siswa


// Set width kolom
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(50); // Set width kolom B
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(50); // Set width kolom C
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(40); // Set width kolom E

$q_memo = mysqli_query($koneksi, "SELECT * FROM mm_det_memo WHERE id_memo = '$idmemo'");

$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
while ($d_memo = mysqli_fetch_array($q_memo)) {
    $nama_koas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_koas WHERE nim = '$d_memo[nim]'"));
    $stase = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_stase WHERE id_stase = '$mm[id_stase]'"));
    $rs = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_rs WHERE id_rs = '$mm[id_rs]'"));

	$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
	$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $rs['nama_rs']);
	$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $stase['nama_stase']);
	$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $nama_koas['nim']);
	$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $nama_koas['nama']);

	$nilai = 'F';
	$q_ujian_2 = mysqli_query($koneksi, "SELECT * FROM ipt_ujian");
  	while ($d_ujian_2=mysqli_fetch_array($q_ujian_2)){
  		$q_nilai_2 = mysqli_query($koneksi, "SELECT * FROM ipt_nilai WHERE nim='$d_memo[nim]' AND id_ujian='$d_ujian_2[id_ujian]' AND id_stase = '$mm[id_stase]'");
  		$d_nilai_2 = mysqli_fetch_array($q_nilai_2);
  		if (empty($d_nilai_2)) {
  			$excel->setActiveSheetIndex(0)->setCellValue($nilai.$numrow, "-");
  		}else{
			$excel->setActiveSheetIndex(0)->setCellValue($nilai.$numrow, $d_nilai_2['nilai']);
		}
		$nilai = chr(ord($nilai) + 1);
	}
	
	
	// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
	$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
	$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);

	$mulai1 = 'F';
	$q_ujian = mysqli_query($koneksi, "SELECT * FROM ipt_ujian");
	while ($d_ujian = mysqli_fetch_array($q_ujian)){
		$excel->getActiveSheet()->getStyle($mulai1.$numrow)->applyFromArray($style_coln);
	  $mulai1 = chr(ord($mulai1) + 1);
	}
	
	$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
	
	$no++; // Tambah 1 setiap kali looping
	$numrow++; // Tambah 1 setiap kali looping
}

// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("EXPORT NILAI");
$excel->setActiveSheetIndex(0);

// Proses file excel
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment; filename=Nilai Koas.xlsx"); // Set nama file excel nya
header("Cache-Control: max-age=0");

$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$write->save('php://output');
}
?>