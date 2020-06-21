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
    print_r($links);
    $this->assertEquals(
      10,
      count($links)
    );
  }

  protected function tearDown():void{
  }

  public static function tearDownAfterClass():void{
  }

}
