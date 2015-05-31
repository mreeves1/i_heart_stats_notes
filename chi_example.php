<?php
require __DIR__ . '/classes/Chi.php';
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
          <?php

          // Problem 1:
          $c1 = new Chi();
          echo "<h2>Halloween Rent vs. Own</h2>\n";
          $c1->inputFile('halloween.txt');
          $observedValues1 = $c1->calculateObservedValues();
          $expectedValues1 = $c1->calculateExpectedValues($observedValues1);
          $chiSquareValues1 = $c1->calculateChiSquareValues($observedValues1, $expectedValues1);
          $chiSquareSolution1 = $c1->calculateChiSquareSolution($chiSquareValues1);
          $degreesOfFreedom1 = $c1->calculateDegreesOfFreedom($observedValues1);
          $criticalChiSquareValue1 = $c1->getChiSquareCriticalValue('.050', $degreesOfFreedom1);
          echo $c1->renderTable($observedValues1);
          echo "<br/>\n";
          echo $c1->renderTable($expectedValues1);
          echo "<br/>\n";
          echo $c1->renderTable($chiSquareValues1);
          echo "<br/>\n";
          echo "Solution: $chiSquareSolution1";
          echo "<br/>\n";
          echo "Degrees of Freedom: $degreesOfFreedom1";
          echo "<br/>\n";
          echo "Critical Chi Square Value: $criticalChiSquareValue1";
          echo "<br/>\n";

          // Problem 2:
          $c2 = new Chi();
          echo "<h2>Birthing</h2>\n";
          $c2->inputFile('birthing.txt');
          $observedValues2 = $c2->calculateObservedValues();
          echo $c2->renderTable($observedValues2);
          echo "<br/>\n";

          // Problem 3:
          $c3 = new Chi();
          echo "<h2>Company Party</h2>\n";
          $c3->inputFile('company_party.txt');
          $observedValues3 = $c3->calculateObservedValues();
          echo $c3->renderTable($observedValues3);
          echo "<br/>\n";

          // Chi Square Critical Value example
          echo "chi square value for a significance level of .050 and df of 1 is ".Chi::getChiSquareCriticalValue('.050', 1).".\n";
          echo "<br/><br/>\n";
          ?>
        </div>

      </div>
    </div>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="vendor/twitter/bootstrap/dist/bootstrap.js"></script>
  </body>
</html>
