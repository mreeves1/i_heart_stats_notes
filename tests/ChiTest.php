<?php
require __DIR__ . '/../vendor/autoload.php';

class ChiTest extends PHPUnit_Framework_TestCase {

  protected static $chi;

  public static function setUpBeforeClass() {
    // Suss out if this is acceptable...
    self::$chi = new Chi();
  }

  public function testBadGetChiSquareTable() {
    $this->setExpectedExceptionRegExp(
        'InvalidArgumentException', '/Significance level of .040 not found/', 0
    );
    $out_actual = Chi::getChiSquareTable('.040');
  }

  public function testGoodGetChiSquareTable() {
    $out_expected = array(
      1 => 3.841,
      2 => 5.991,
      3 => 7.815,
      4 => 9.488,
      5 => 11.071,
      6 => 12.592,
      7 => 14.067,
      8 => 15.507,
      9 => 16.919,
      10 => 18.307,
      11 => 19.675,
      12 => 21.026,
      13 => 22.362,
      14 => 23.685,
      15 => 24.996,
      16 => 26.296,
      17 => 27.587,
      18 => 28.869,
      19 => 30.144,
      20 => 31.410
    );
    $out_actual = Chi::getChiSquareTable('.050');
    $this->assertEquals($out_actual, $out_expected);
  }

  public function testGetChiSquareCriticalValue() {
    $out_actual = Chi::getChiSquareCriticalValue('.050',13);
    $out_expected = 22.362;
    $this->assertEquals($out_actual, $out_expected);
  }

  public function testInputArray() {
    $in = array (
        0 =>
            array (
                0 => 'Own or Rent?',
                1 => 'Decorate for Halloween?',
            ),
        1 =>
            array (
                0 => 'own',
                1 => 'yes',
            ),
        2 =>
            array (
                0 => 'own',
                1 => 'no',
            ),
        3 =>
            array (
                0 => 'own',
                1 => 'yes',
            ),
        4 =>
            array (
                0 => 'own',
                1 => 'yes',
            ),
        5 =>
            array (
                0 => 'own',
                1 => 'yes',
            ),
        6 =>
            array (
                0 => 'rent',
                1 => 'no',
            ),
        7 =>
            array (
                0 => 'own',
                1 => 'no',
            ),
        8 =>
            array (
                0 => 'rent',
                1 => 'no',
            ),
        9 =>
            array (
                0 => 'rent',
                1 => 'no',
            ),
        10 =>
            array (
                0 => 'rent',
                1 => 'yes',
            ),
        11 =>
            array (
                0 => 'own',
                1 => 'yes',
            ),
        12 =>
            array (
                0 => 'own',
                1 => 'no',
            ),
        13 =>
            array (
                0 => 'rent',
                1 => 'no',
            ),
        14 =>
            array (
                0 => 'own',
                1 => 'no',
            ),
        15 =>
            array (
                0 => 'own',
                1 => 'yes',
            ),
        16 =>
            array (
                0 => 'own',
                1 => 'yes',
            ),
        17 =>
            array (
                0 => 'own',
                1 => 'yes',
            ),
        18 =>
            array (
                0 => 'own',
                1 => 'yes',
            ),
        19 =>
            array (
                0 => 'own',
                1 => 'yes',
            ),
        20 =>
            array (
                0 => 'rent',
                1 => 'yes',
            )
    );

    self::$chi->inputArray($in);
    $out_actual = self::$chi->getData();

    $out_expected = array (
      'own' =>
          array (
              'yes' => 10,
              'no' => 4,
          ),
      'rent' =>
          array (
              'no' => 4,
              'yes' => 2,
          ),
    );

    $this->assertEquals($out_actual, $out_expected);
  }

  public function testCalculateObservedValues() {
    $out_actual = self::$chi->calculateObservedValues();

    $out_expected = array(
        array(
            'OBSERVED',
            'own',
            'rent',
            'total'
        ),
        array(
            'no',
            4,
            4,
            8
        ),
        array(
            'yes',
            10,
            2,
            12
        ),
        array(
            'total',
            14,
            6,
            20
        )
    );

    $this->assertEquals($out_actual, $out_expected);
  }

}