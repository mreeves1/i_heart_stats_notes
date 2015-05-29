<?php
require __DIR__ . '/../vendor/autoload.php';

class Common {

  public static function calcStdDev(array $numbers, $sig_digits = 5) {
    // TODO: Add validation?

    $mean = self::calcMean($numbers, $sig_digits);
    // The use syntax allow us to import vars from outside the local scope
    $mean_diff_pow_func = function($number) use ($mean) {
      return pow($number - $mean, 2);
    };

    $numbers_new = array_map($mean_diff_pow_func, $numbers);
    return round(sqrt((array_sum($numbers_new)/(count($numbers)-1))), $sig_digits);
  }

  public static function calcMean(array $numbers, $sig_digits = 5) {
    // TODO: Add validation?

    return round((array_sum($numbers)/count($numbers)), $sig_digits);
  }

}
