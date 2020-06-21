<?php
// set_time_limit(120);
set_time_limit(0);
include("simple_html_dom.php");
class LotteryResultScraper{
  public function getResultPage(){
    // $html = file_get_html("https://google.com");
    // $html = file_get_html("http://www.keralalotteries.com/index.php/quick-view/result");
    $html = file_get_html("http://www.keralalotteries.in/");
    foreach ($html->find('a') as $element) {
      echo $element->href."<br>";
    }
  }
}
$obj = new LotteryResultScraper;
$obj->getResultPage();
?>
