<?php
$page = 'chi_ex';

require __DIR__ . '/classes/Chi.php';
include_once __DIR__ . '/includes/header.php';
?>
<div class="row">
  <div class="col-sm-6">
    <?php
    // Problem 1:
    $problem_label1 = "Halloween Rent vs. Own";
    $chi1 = new Chi();
    $chi1->inputFile('chi_halloween.txt');
    $isTestTrue = $chi1->calculateAll();

    echo "<h2>$problem_label1</h2>\n";
    echo Common::renderTable($chi1->getObserved(), "Observed Values");
    echo "<br/>\n";
    echo Common::renderTable($chi1->getExpected(), "Expected Values");
    echo "<br/>\n";
    echo Common::renderTable($chi1->getChiSqrValues(), "Chi Square Values");
    echo "<br/>\n";
    echo Common::renderValue($chi1->getDegreesOfFreedom(), "Degrees of Freedom");
    echo "<br/>\n";
    echo Common::renderValue($chi1->getChiSqrCritVal(), "Critical Chi Square Value");
    echo "<br/>\n";
    echo Common::renderValue($chi1->getChiSqrSolution(), "Chi Square Solution");
    echo "<br/>\n";
    echo Common::renderValue(($isTestTrue ? "Chi^2 Test Passed, Reject Null Hypothesis" : "Chi^2 Test Failed, Accept Null Hypothesis"),"Results");
    echo "<br/>\n";
    ?>
  </div>
  <div class="col-sm-6">
    <?php
    // Problem 2:
    $problem_label2 = "Birthing";
    $chi2 = new Chi();
    $chi2->inputFile('chi_birthing.txt');
    $isTestTrue = $chi2->calculateAll();

    echo "<h2>$problem_label2</h2>\n";
    echo Common::renderTable($chi2->getObserved(), "Observed Values");
    echo "<br/>\n";
    echo Common::renderTable($chi2->getExpected(), "Expected Values");
    echo "<br/>\n";
    echo Common::renderTable($chi2->getChiSqrValues(), "Chi Square Values");
    echo "<br/>\n";
    echo Common::renderValue($chi2->getDegreesOfFreedom(), "Degrees of Freedom");
    echo "<br/>\n";
    echo Common::renderValue($chi2->getChiSqrCritVal(), "Critical Chi Square Value");
    echo "<br/>\n";
    echo Common::renderValue($chi2->getChiSqrSolution(), "Chi Square Solution");
    echo "<br/>\n";
    echo Common::renderValue(($isTestTrue ? "Chi^2 Test Passed, Reject Null Hypothesis" : "Chi^2 Test Failed, Accept Null Hypothesis"),"Results");
    echo "<br/>\n";
    ?>
  </div>
  <div class="col-sm-6">
    <?php
    // Problem 3:
    $problem_label3 = "Company Party";
    $chi3 = new Chi();
    $chi3->inputFile('chi_company_party.txt');
    $isTestTrue = $chi2->calculateAll();

    echo "<h2>$problem_label3</h2>\n";
    echo Common::renderTable($chi2->getObserved(), "Observed Values");
    echo "<br/>\n";
    echo Common::renderTable($chi2->getExpected(), "Expected Values");
    echo "<br/>\n";
    echo Common::renderTable($chi2->getChiSqrValues(), "Chi Square Values");
    echo "<br/>\n";
    echo Common::renderValue($chi2->getDegreesOfFreedom(), "Degrees of Freedom");
    echo "<br/>\n";
    echo Common::renderValue($chi2->getChiSqrCritVal(), "Critical Chi Square Value");
    echo "<br/>\n";
    echo Common::renderValue($chi2->getChiSqrSolution(), "Chi Square Solution");
    echo "<br/>\n";
    echo Common::renderValue(($isTestTrue ? "Chi^2 Test Passed, Reject Null Hypothesis" : "Chi^2 Test Failed, Accept Null Hypothesis"),"Results");
    echo "<br/>\n";
    ?>
  </div>
</div>
<?php include_once __DIR__ . '/includes/footer.php';