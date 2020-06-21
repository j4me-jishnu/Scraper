<?php
include('simple_html_dom.php');
include('PdfToText.phpclass');

// $html = file_get_html('http://103.251.43.52/lottery/reports/draw/tmp70500.pdf');
$pdf = new PdfToText('http://103.251.43.52/lottery/reports/draw/tmp70500.pdf');
$string = "1st Prize";
$data = $pdf->Text;
if(strpos($data, $string) !== false){
  echo $string;
}
else{
  echo "Not found";
}
// foreach ($html->find('a') as $element) {
//   echo $element->href."<br>";
// }

 ?>
