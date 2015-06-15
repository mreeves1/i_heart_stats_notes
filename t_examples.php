<?php
$page = 't_ex';

require __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/includes/header.php';
?>
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <?php

    // Problem 1:
    echo "<h2>Men vs. Women Hair Care Product Count</h2>\n";
    $data1 = T::inputFile('t_hair_care.txt', ",");
    $t1 = new T($data1);
    echo Common::renderTable($t1->getData());
    echo "<br/>\n";

/*
    $observedValues1 = $c1->calculateObservedValues();
    $expectedValues1 = $c1->calculateExpectedValues($observedValues1);
    $chiSquareValues1 = $c1->calculateChiSquareValues($observedValues1, $expectedValues1);
    $chiSquareSolution1 = $c1->calculateChiSquareSolution($chiSquareValues1);
    $degreesOfFreedom1 = $c1->calculateDegreesOfFreedom($observedValues1);
    $criticalChiSquareValue1 = $c1->getChiSquareCriticalValue('.050', $degreesOfFreedom1);
    echo $t1->renderTable($observedValues1);
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
*/
    ?>
  </div>

</div>
<?php include_once __DIR__ . '/includes/footer.php';