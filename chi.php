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
          $problem_label = "Halloween Rent vs. Own";
          $chi = new Chi();
          $chi->inputFile('halloween.txt');
          $isTestTrue = $chi->calculateAll();

          echo "<h2>$problem_label</h2>\n";
          echo Common::renderTable($chi->getObserved(), "Observed Values");
          echo "<br/>\n";
          echo Common::renderTable($chi->getExpected(), "Expected Values");
          echo "<br/>\n";
          echo Common::renderTable($chi->getChiSqrValues(), "Chi Square Values");
          echo "<br/>\n";
          echo Common::renderValue($chi->getDegreesOfFreedom(), "Degrees of Freedom");
          echo "<br/>\n";
          echo Common::renderValue($chi->getChiSqrCritVal(), "Critical Chi Square Value");
          echo "<br/>\n";
          echo Common::renderValue($chi->getChiSqrSolution(), "Chi Square Solution");
          echo "<br/>\n";
          echo Common::renderValue(($isTestTrue ? "Chi^2 Test Passed, Reject Null Hypothesis" : "Chi^2 Test Failed, Accept Null Hypothesis"),"Results");
          echo "<br/>\n";
          ?>
        </div>

      </div>
    </div>
  <script src="vendor/components/jquery/jquery.min.js"></script>
  <script src="vendor/twitter/bootstrap/dist/bootstrap.js"></script>
  </body>
</html>
