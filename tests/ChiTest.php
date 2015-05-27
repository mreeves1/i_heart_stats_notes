<?php
require __DIR__ . '/../vendor/autoload.php';
# require __DIR__ . '/../classes/Chi.php';

class ChiTest extends PHPUnit_Framework_TestCase {
  protected static $chi;

  public static function setUpBeforeClass() {
    // Suss out if this is acceptable...
    self::$chi = new Chi();
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
