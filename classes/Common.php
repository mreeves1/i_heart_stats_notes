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
    # The -1 in the denominator is to remove the title column
    return round(sqrt((array_sum($numbers_new)/(count($numbers)-1))), $sig_digits);
  }

  public static function calcMean(array $numbers, $sig_digits = 5) {
    // TODO: Add validation?

    return round((array_sum($numbers)/count($numbers)), $sig_digits);
  }

  public static function renderTable(array $values, $label = null) {
    $html  = "<div class=\"table-responsive\">\n";
    if (!empty($label)) {
      $html .=  "\t<h4>$label</h4>\n";
    }
    $html .=  "\t<table class=\"table table-bordered\">\n";
    for ($i = 0; $i < count($values); $i++) {
      $html .= "\t\t<tr>\n";
      $j_max = count($values[$i]);
      for ($j = 0; $j < $j_max; $j++) {
        $html .= $i == 0 ? "\t\t\t<th>" : "\t\t\t<td>";
        $html .= $values[$i][$j];
        $html .= $i == 0 ? "</th>\n" : "</td>\n";
      }
      $html .= "\t\t</tr>\n";
    }
    $html .= "\t</table>\n";
    $html .= "</div>\n";
    return $html;
  }

  public static function renderValue($value, $label) {
    $html  = "<div><b>$label</b>: $value</div>\n";
    return $html;
  }

}
