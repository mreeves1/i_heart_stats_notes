<?php
// Calculate T for I Heart Stats Homework
require __DIR__ . '/../vendor/autoload.php';

Class T extends Base
{

  const DEBUG = false;

  private $var1_label;
  private $var2_label;
  private $data = array();
  private $observed = array();
  private $expected = array();
  private $degrees_of_freedom = 0;

  public function __construct($input) {
    $this->inputArray($input);
  }

  /**
   * @return array
   */
  public function getObserved() {
    return $this->observed;
  }

  /**
   * @return array
   */
  public function getExpected() {
    return $this->expected;
  }

  /**
   * @return int
   */
  public function getDegreesOfFreedom() {
    return $this->degrees_of_freedom;
  }

  public function getData() {
    return $this->data;
  }

  public function inputArray(array $a) {
    $data = array();
    $var1_vals = array();
    $var2_vals = array();
    for ($i = 0; $i < count($a); $i++) {
      // TODO: Validation checks?
      if ($i == 0) {
        $this->var1_label = $a[0][0];
        $this->var2_label = $a[0][1];
      }
      else {
        if (isset($a[$i][0])) {
          $var1_vals[] = $a[$i][0];
        }
        if (isset($a[$i][1])) {
          $var2_vals[] = $a[$i][1];
        }
      }
    }
    $data[0] = $var1_vals;
    $data[1] = $var2_vals;
    $this->data = $data;
    self::debugPrint($this->data, __METHOD__.", data");
  }
}