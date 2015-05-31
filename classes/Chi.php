<?php
// Calculate Chi Square for I Heart Stats Homework
require __DIR__ . '/../vendor/autoload.php';

  Class Chi {
    const FILES_DIR = 'files';
    const DS = DIRECTORY_SEPARATOR;
    const DEBUG = false;

    private $independent_var;
    private $dependent_var;
    private $data = array();

    private function debugPrint($var, $label = null){
      if (self::DEBUG) {
        echo "<pre>";
        if (!is_null($label)) echo "<b>$label:</b> \n";
        echo var_export($var, true);
        echo "</pre>\n";
      }
    }

    public function getData() {
      return $this->data;
    }

    public function inputFile($f) {
      $file = self::FILES_DIR.self::DS.$f;
      if (!is_file($file)) {
        throw new Exception("File $f not found");
      }
      $fh = fopen($file,'r');
      $a = array();
      while (($line = fgetcsv($fh, 1024, "\t")) !== false) {
        $a[] = $line;
      }

      self::inputArray($a);
    }

    public function inputArray($a) {
      $data = array();
      for ($i = 0; $i < count($a); $i++) {
        // TODO: Validation checks?
        if ($i == 0) {
          $this->independent_var = $a[0][0];
          $this->dependent_var = $a[0][1];
        }
        else {
          $i_var = $a[$i][0];
          $d_var = $a[$i][1];
          if (isset($data[$i_var]) && isset($data[$i_var][$d_var])) {
            $data[$i_var][$d_var] += 1;
          }
          else {
            $data[$i_var][$d_var] = 1;
          }
        }
      }
      $this->data = $data;
      self::debugPrint($this->data, __METHOD__.", data");
    }

    /**
     *
     *
     * @ref https://courses.edx.org/c4x/NotreDameX/SOC120x/asset/Chi_Square.pdf
     * @ref https://people.richland.edu/james/lecture/m170/tbl-chi.html
     */
    static function getChiSquareTable($sig_level) {
      // $a[significance level][degrees of freedom] = critical value
      $a = array();
      $a['.050'][1] = 3.841;
      $a['.050'][2] = 5.991;
      $a['.050'][3] = 7.815;
      $a['.050'][4] = 9.488;
      $a['.050'][5] = 11.071;
      $a['.050'][6] = 12.592;
      $a['.050'][7] = 14.067;
      $a['.050'][8] = 15.507;
      $a['.050'][9] = 16.919;
      $a['.050'][10] = 18.307;
      $a['.050'][11] = 19.675;
      $a['.050'][12] = 21.026;
      $a['.050'][13] = 22.362;
      $a['.050'][14] = 23.685;
      $a['.050'][15] = 24.996;
      $a['.050'][16] = 26.296;
      $a['.050'][17] = 27.587;
      $a['.050'][18] = 28.869;
      $a['.050'][19] = 30.144;
      $a['.050'][20] = 31.410;

      $sig_levels = array();
      foreach ($a as $k => $v) {
        $sig_levels[] = $k;
      }

      if (!isset($a[$sig_level])) {
        throw new InvalidArgumentException("Significance level of $sig_level not found. Possible significance levels are ".implode(", ", $sig_levels).".");
      } else {
        return $a[$sig_level];
      }
    }

    static function getChiSquareCriticalValue($sig_level, $degree_of_freedom) {
      $chi_square_table = self::getChiSquareTable($sig_level);

      if (!isset($chi_square_table[$degree_of_freedom])) {
        throw new Exception("Chi Square degree of freedom of $degree_of_freedom not found. Possible degrees of freedom are ".implode(", ", $chi_square_table[$degree_of_freedom]).".");
      } else {
        return round($chi_square_table[$degree_of_freedom],3);
      }
    }

    public function calculateObservedValues($prefix = false) {
      // TODO: Add prefix functionality where the indep/dep vars are prefixed onto rows/columns (aka yes/no = boring)
      $values = array();
      if (empty($this->independent_var) || empty($this->dependent_var) || empty($this->data)) {
        throw new Exception("Missing critical values. Run input methods first!");
      } else {
        $cols = array('OBSERVED');
        $rows = array();
        foreach ($this->data as $k1 => $v1) {
          $cols[] = $k1;
          foreach ($v1 as $k2 => $v2) {
            $rows[] = $k2;
          }
        }
        $cols[] = 'total';
        self::debugPrint($cols, __METHOD__.", cols");

        $rows = array_unique($rows);
        sort($rows);
        self::debugPrint($rows, __METHOD__.", rows");

        $values[] = $cols;
        $c_total = array('total');
        $grand_total = 0;
        for ($r = 0; $r < count($rows); $r++) {
          $tmp = array($rows[$r]);
          $r_total = 0;
          for ($c = 1; $c < count($cols) - 1; $c++) { // Stop one column short for totals
            if (isset($this->data[$cols[$c]]) && isset($this->data[$cols[$c]][$rows[$r]])) {
              $val = $this->data[$cols[$c]][$rows[$r]];
              $tmp[] = $val;
              $r_total += $val;
              $grand_total += $val;
              if (isset($c_total[$c])) {
                $c_total[$c] += $val;
              } else {
                $c_total[$c] = $val;
              }
            } else {
              $tmp[] = 0;
            }
          }
          $tmp[] = $r_total; // final column
          $values[] = $tmp;
        }
        // Calculate grand total;
        $c_total[count($cols) - 1] = $grand_total;
        $values[] = $c_total;
        self::debugPrint($values, __METHOD__.", values");
        return $values;
      }
    }

    public function calculateExpectedValues($observed) {
      $expected = $observed;
      $expected[0][0] = 'EXPECTED';
      $i_max = count($observed) - 1;
      $j_max = count($observed[$i_max]) - 1;
      $total = $observed[$i_max][$j_max];
      for ($i = 1; $i < $i_max; $i++) {
        for ($j = 1; $j < $j_max; $j++) {
          $expected[$i][$j] = $observed[$i][$j_max] * $observed[$i_max][$j] / $total;
        }
      }
      return $expected;
    }

    public function calculateChiSquareValues($observed, $expected) {
      $i_max = count($observed) - 1;
      $j_max = count($observed[$i_max]) - 1;
      $values = array(array('OBSERVED', 'EXPECTED', 'O - E', '(O - E)^2', '(O - E)^2 / E'));
      for ($i = 1; $i < $i_max; $i++) {
        for ($j = 1; $j < $j_max; $j++) {
          $tmp = array();
          $tmp[0] = $observed[$i][$j];
          $tmp[1] = $expected[$i][$j];
          $tmp[2] = $tmp[0] - $tmp[1];
          $tmp[3] = pow($tmp[2],2);
          $tmp[4] = $tmp[3] / $tmp[1];
          $values[] = $tmp;
        }
      }
      return $values;
    }

    public function calculateChiSquareSolution($values) {
      $solution = 0;
      for ($i = 1; $i < count($values); $i++) {
        $solution += $values[$i][4];
      }
      return $solution;
    }

    public function calculateDegreesOfFreedom($expected_or_observed) {
      // -2 to remove "label" columns and rows
      $x = count($expected_or_observed[0]) - 2;
      $y = count($expected_or_observed) - 2;
      $df = ($y - 1) * ($x - 1);
      return $df;
    }

    public function renderTable($values) {
      $html  = "<div class=\"table-responsive\">\n";
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

  }
?>
