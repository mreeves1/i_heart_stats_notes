<?php
require __DIR__ . '/../vendor/autoload.php';

class CommonTest extends PHPUnit_Framework_TestCase {

  public function testCalcMean() {
    $numbers_in = array(12, 20, 40, 13, 2, 17, 19, 34);
    $out_expected = 19.625;
    $out_actual = Common::calcMean($numbers_in);
    $this->assertEquals($out_actual, $out_expected);
  }

  public function testCalcStdDev() {
    $numbers_in = array(12, 20, 40, 13, 2, 17, 19, 34);
    $out_expected = 12.19997;
    $out_actual = Common::calcStdDev($numbers_in);
    $this->assertEquals($out_actual, $out_expected);
  }

}