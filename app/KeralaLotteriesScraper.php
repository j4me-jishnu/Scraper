<?php declare(strict_types=1);
include 'vendor/autoload.php';
use SimpleHtmlDomWrapper as SimpleHtmlDomWrapper;

class KeralaLotteriesScraper{
  public $pdf_data = "";
  
  private function is_direct_link($link){
    return strpos($link,'.pdf')!==FALSE;
  }

  private function get_direct_link($link){
    return "http://103.251.43.52/lottery/{$link}";
  }

  private function get_draw_number($link){
    $draw_number="";
    $matched=preg_match("/^.*?([\d]{4,}).*?$/si",$link,$matches);
    if($matched){
      $draw_number=$matches[1];
      return "http://103.251.43.52/lottery/reports/resultentryeport1.php?drawno1={$draw_number}&drawno={$draw_number}";
    }
  }

  public function getResultLinks(){
    $links=[];
    $html=SimpleHtmlDomWrapper::file_get_html("http://103.251.43.52/lottery/weblotteryresult.php");
    $table=$html->find('table[class="stats"]',0);
    if($table){
      $a_tags=$table->find('td[align="center"]>a');
      foreach($a_tags as $a_tag){
        if($this->is_direct_link($a_tag->href)){
          array_push($links,$this->get_direct_link($a_tag->href));
        }else{
          array_push($links,$this->get_draw_number($a_tag->href));
        }
      }
    }
    return $links;
  }

  public function getPdf($link){
    if(trim($link)==""){
      throw new Exception("Invalid Link", 1);
    }
    else{
      $context = stream_context_create(array ('http' => array(
            'follow_location' => true,
            'max_redirects' => 20
        )));
      if($result = file_get_contents($link, false, $context)){
        $this->pdf_data = $result;
        return true;
      }
    }
  }

  public function PdfToText($pdf_data){
    $parser = new \Smalot\PdfParser\Parser();
    $pdf    = $parser->parseFile($pdf_data);
    if($text = $pdf->getText()){
      return true;
    }
  }

  public function getWinningSlot($text, $regex){

  }

}
