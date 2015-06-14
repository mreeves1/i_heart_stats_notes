<?php
$page = 'home';

require __DIR__ . '/classes/Chi.php';
include_once __DIR__ . '/includes/header.php';
?>
  <div class="row">
    <div class="col-sm-8 col-sm-offset-1" >
      <?php
        $readme = file_get_contents('README.md');
        $p = new Parsedown();
        echo $p->text($readme);
      ?>
    </div>
  </div>
<?php include_once __DIR__ . '/includes/footer.php';