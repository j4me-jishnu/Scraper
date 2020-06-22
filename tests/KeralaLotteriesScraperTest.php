<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class KeralaLotteriesScraperTest extends TestCase{
  private static $app;

  public static function setUpBeforeClass(): void{
    self::$app=new KeralaLotteriesScraper();
  }

  protected function setUp():void{
  }

  public function testCanCreateApp(): void{
    $this->assertInstanceOf(
      KeralaLotteriesScraper::class,
      self::$app
    );
  }

  public function testCanGetResultLinks(): void{
    $links=self::$app->getResultLinks();
    // print_r($links);
    $this->assertEquals(
      10,
      count($links)
    );
  }

  public function testCanConvertLinkToPdfLink(): void{
    $link = "http://103.251.43.52/lottery/reports/resultentryeport1.php?drawno1=70560&drawno=70560";
    $pdf_link = self::$app->convertlinkToPdfLink($link);
    $this->assertEquals($pdf_link, "http://103.251.43.52/lottery/reports/draw/tmp70560.pdf");
  }
  public function testCannotConvertlinkIfNoLink(): void{
    $this->expectExceptionMessage("Invalid Link");
    $link = "";
    self::$app->convertlinkToPdfLink($link);
  }
  public function testAppCanConvertPdfToText(): void{
    $link = "http://103.251.43.52/lottery/reports/draw/tmp70560.pdf";
    self::$app->convertPdfDataIntoString($link);
  }






  // public function testAppCannotGetDataIfNoLink(): void{
  //     $this->expectExceptionMessage('Invalid link');
  //     $link="";
  //     self::$app->extractPDF($link);
  // }
  // public function testCanGetPdf(): void{
  //   $data = "http://103.251.43.52/lottery/reports/resultentryeport1.php?drawno1=70560&drawno=70560";
  //   $pdf_data=self::$app->extractPDF($data);
  //   print_r($pdf_data);
  //   $this->assertEquals($pdf_data, true);
  // }



  protected function tearDown():void{
  }

  public static function tearDownAfterClass():void{
  }

}
