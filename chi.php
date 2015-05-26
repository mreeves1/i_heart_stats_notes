<?php
// Calculate Chi Square for I Heart Stats Homework
require __DIR__ . '/vendor/autoload.php';

  Class Chi {
    const FILES_DIR = 'files';
    const DS = DIRECTORY_SEPARATOR;
    const DEBUG = true;

    private $independent_var;
    private $dependent_var;
    private $data = array();

    private function debugPrint($var, $label = null){
      if (self::DEBUG) {
        echo "<pre>";
        if (!is_null($label)) echo "<b>$label:</b> \n";
        echo var_export($var, true);
        echo "</pre>";
      }
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
        throw new Exception("Significance level of $sig_level not found. Possible significance levels are ".implode(", ", $sig_levels).".");
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

    public function renderObservedValues($prefix = false) {
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
      }
    }

  }
  $c1 = new Chi();
  $c1->inputFile('halloween.txt');
  echo $c1->renderObservedValues();

  $c2 = new Chi();
  $c2->inputFile('birthing.txt');
  echo $c2->renderObservedValues();
  echo "\n";
  echo "chi square value for a significance level of .050 and df of 1 is ".Chi::getChiSquareCriticalValue('.050', 1).".";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Chi Square Calculator</title>
    <link href="vendor/twitter/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
  </head>
  <body>
    <div class="container-fluid">
      <div class="jumbotron img-rounded" >
        <h1>Chi Square Calculator</h1>
      </div>
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          TODO...
        </div>

      </div>
    </div>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="vendor/twitter/bootstrap/dist/bootstrap.js"></script>
  </body>
</html>