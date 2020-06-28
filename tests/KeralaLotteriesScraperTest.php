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
    $this->assertEquals(
      10,
      count($links)
    );
  }

  public function testCanGetPdf(): void{
    $links=self::$app->getResultLinks();
    $pdf=self::$app->getPdf($links[0]);
    $this->assertNotEquals(
      false,
      $pdf
    );
  }

  public function testCannotGetPdfIfNoLink(): void{
    $this->expectExceptionMessage("Invalid Link");
    $link = "";
    self::$app->getPdf($link);
  }

  public function testPdftoText(): void{
    $link = "http://103.251.43.52/lottery/reports/draw/tmp70560.pdf";
    $readed_data = self::$app->PdfToText($link);
    $this->assertEquals($readed_data, true);
  }

  protected function tearDown():void{
  }

  public static function tearDownAfterClass():void{
  }

}
