<?php
$pages = array(
    0 => array('id' => 'home', 'url' => 'index.php', 'title' => 'Home'),
    1 => array('id' => 'chi_ex', 'url' => 'chi_examples.php', 'title' => 'Chi-Square Examples'),
    2 => array('id' => 'chi_calc', 'url' => 'chi_calculator.php', 'title' => 'Chi-Square Calculator'),
    3 => array('id' => 't_ex', 'url' => 't_examples.php', 'title' => 'T Examples'),
    4 => array('id' => 't_calc', 'url' => 't_calculator.php', 'title' => 'T Calculator'),
);

// Navigation
switch ($page) {
  case 'home':
    $page_title = 'I <3 Stats Notes';
    $page_url = 'index.php';
    break;
  case 'chi_calc':
    $page_title = 'Chi-Square Calculator';
    $page_url = 'chi_calculator.php';
    break;
  case 'chi_ex':
    $page_title = 'Chi-Square Examples';
    $page_url = 'chi_examples.php';
    break;
  case 't_calc':
    $page_title = 'T Calculator';
    $page_url = 't_calculator.php';
    break;
  case 't_ex':
    $page_title = 'T Examples';
    $page_url = 't_examples.php';
    break;
  default:
    $page_title = 'Unknown';
    $page_url = '404.php';
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title><?php echo $page_title;?></title>
  <link href="vendor/twitter/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  <div class="container-fluid">
    <nav class="navbar navbar-inverse">
      <a class="navbar-brand" href="https://courses.edx.org/courses/NotreDameX/SOC120x/2T2015/info" target="_blank">I <3 Stats</a>
      <ul class="nav navbar-nav">
        <?php
        foreach ($pages as $k => $p) {
          echo $page === $p['id'] ? '<li class="active">' : '<li>';
          echo '<a href="'.$p['url'].'">'.$p['title'].'</a></li>'."\n";
        }
        ?>
      </ul>
    </nav>
    <div class="jumbotron img-rounded" >
      <h1><?php echo $page_title;?></h1>
    </div>