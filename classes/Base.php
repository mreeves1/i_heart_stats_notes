<?php
require __DIR__ . '/../vendor/autoload.php';

abstract class Base {
  const FILES_DIR = 'files';
  const DS = DIRECTORY_SEPARATOR;

  const DEBUG = false;

  public function __construct($input) {
    $this->inputArray($input);
  }

  public static function inputFile($f, $field_delimiter = "\t") {
    $file = self::FILES_DIR.self::DS.$f;
    if (!is_file($file)) {
      throw new Exception("File $f not found");
    }
    $fh = fopen($file,'r');
    $a = array();
    while (($line = fgetcsv($fh, 1024, $field_delimiter)) !== false) {
      $a[] = $line;
    }
    self::debugPrint($a, __METHOD__.", a");
    return $a;
  }

  abstract public function inputArray(array $a);

  protected static function debugPrint($var, $label = null) {
    if (self::DEBUG) {
      echo "<pre>";
      if (!is_null($label)) echo "<b>$label:</b> \n";
      echo var_export($var, true);
      echo "</pre>\n";
    }
  }

}

?>