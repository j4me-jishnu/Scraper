<?php declare(strict_types=1);
include 'vendor/autoload.php';
use SimpleHtmlDomWrapper as SimpleHtmlDomWrapper;

class KeralaLotteriesScraper{
  private function get_redirect_link($response,$link){
    preg_match("/\'(.*?)\'/si",$response,$redirect_url);
    preg_match("/(http.*\/)/si",$link,$pre);
    return "{$pre[1]}{$redirect_url[1]}";
  }

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
      throw new Exception("Invalid Link");
    }
    $context=stream_context_create([
      'http'=>[
        'follow_location'=>true
      ]
    ]);
    $response=file_get_contents($link,false,$context);
    $redirect_url=$this->get_redirect_link($response,$link);
    return file_get_contents($redirect_url,false,$context);
  }

  public function PdfToText($pdf_data){
    $parser=new \Smalot\PdfParser\Parser();
    $pdf=$parser->parseContent($pdf_data);
    return $pdf->getText();
  }

  public function getSlotFromText($text, $regex){

  }

  public function getResultSlotFromText($text){
    $regex = '/1st Prize(.*?)[\s][A-Z]{2}[\s]\d{6}/';
    preg_match_all($regex, $text, $array);
    print_r(substr($array[0][0],-3));
    return substr($array[0][0],-3);
  }
}
