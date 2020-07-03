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
    self::$app->getPdf("");
  }

  public function testCanConvertPdfToText(): void{
    $links=self::$app->getResultLinks();
    $pdf=self::$app->getPdf($links[0]);
    $text=self::$app->PdfToText($pdf);
    $this->assertStringContainsString(
      'KERALA STATE LOTTERIES - RESULT',
      $text
    );
  }

  public function testCanGetResultSlotFromText(): void{
    $links=self::$app->getResultLinks();
    $pdf=self::$app->getPdf($links[0]);
    $text=self::$app->PdfToText($pdf);
    $result=self::$app->getResultSlotFromText($text);
    $this->assertNotEquals(false,$result);
  }

  public function testCannotGetResultSlotFromTextIfResultIsEmpty(): void{
    $this->expectExceptionMessage("Result is empty!");
    self::$app->getResultSlotFromText("");
  }

  protected function tearDown():void{
  }

  public static function tearDownAfterClass():void{
  }


}
