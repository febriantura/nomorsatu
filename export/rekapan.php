<?php 
include "../koneksi.php";
if (isset($_POST['export'])) {
    $lokasi = $_POST['lok'];
ob_start(); ?>
<html>
<head>
  <title>Cetak PDF</title>
    
   <style>
   table {border-collapse:collapse; table-layout:fixed;width: 600px;}
   </style>
</head>
<body>
<?php
    if ($lokasi == "magetan") {
        $rs = "RSUD dr. Sayidiman Magetan";
    }elseif ($lokasi == "ponorogo") {
        $rs = "RSUD Dr. Harjono S. Ponorogo";
    }elseif ($lokasi == "karanganyar") {
        $rs = "RSUD karanganyar";
    }elseif ($lokasi == "sukoharjo") {
        $rs = "RSUD Sukoharjo";
    }else{
        $rs = "";
    }

    $tgl = date("d-m-Y");
?>  
<h1 style="text-align: center;">REKAPAN INPUT NILAI<br><?php echo "$rs"; ?><br>per Tanggal <?php echo "$tgl"; ?><br></h1>
<table border="1" width="100%">
<thead>
              <tr>
                <th style="word-wrap:break-word;width: 5%;text-align: center;">NO</th>
                <th style="word-wrap:break-word;width: 10%;text-align: center;">NIM</th>
                <th style="word-wrap:break-word;width: 25%;text-align: center;">NAMA</th>
                <th style="word-wrap:break-word;width: 20%;text-align: center;">STASE</th>
                <th style="word-wrap:break-word;width: 20%;text-align: center;">RUMAH SAKIT</th>
                <th style="word-wrap:break-word;width: 15%;text-align: center;">UJIAN</th>
                <th style="word-wrap:break-word;width: 5%;text-align: center;">NILAI</th>
              </tr>
            </thead>
            <tbody>
                  <?php
                    include "../koneksi.php";
                    $no = 1;
                    $q_nilai = mysqli_query($koneksi, "SELECT a.nim, a.id_stase, a.id_ujian, a.id_rs, a.nilai, a.keterangan, b.status, b.lokasi FROM ipt_status as b INNER JOIN ipt_nilai as a ON a.id_nilai=b.id_nilai WHERE b.lokasi = '$lokasi' AND b.status = 0");
                    while ($d_nilai = mysqli_fetch_array($q_nilai)) {
                        $nama_koas = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_koas WHERE nim = '$d_nilai[nim]'"));
                        $nama_stase = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_stase WHERE id_stase = '$d_nilai[id_stase]'"));
                        $nama_ujian = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ipt_ujian WHERE id_ujian = '$d_nilai[id_ujian]'"));
                        $nama_rs = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM dt_rs WHERE id_rs = '$d_nilai[id_rs]'"));
                ?>
              <tr>
                <td><?php echo "$no"; ?></td>
                <td><?php echo "$d_nilai[nim]"; ?></td>
                <td><?php echo "$nama_koas[nama]"; ?></td>
                <td><?php echo "$nama_stase[nama_stase]"; ?></td>
                <td><?php echo "$nama_rs[nama_rs]"; ?></td>
                <td><?php echo "$nama_ujian[nama_ujian]"; ?></td>
                <td><?php echo "$d_nilai[nilai]"; ?></td>
              </tr>
          <?php $no++; } ?>
            </tbody>
</table>
</body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();
        
require 'html2pdf/autoload.php';
$pdf = new Spipu\Html2Pdf\Html2Pdf('L','A4','en');
$pdf->WriteHTML($html);
$pdf->Output('Rekap Input Nilai.pdf', 'D');

mysqli_query($koneksi, "UPDATE ipt_status SET status = 1 WHERE lokasi = '$lokasi'");
}
?>