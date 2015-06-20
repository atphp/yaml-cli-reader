<?php
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

require __DIR__ . '/vendor/autoload.php';

error_reporting(E_ALL);
ini_set("display_errors", 1);

$opts = getopt('f::', array('format::'));

// remove script filename
array_shift($argv);

run($argv, $opts);

function run($argv, $opts) {
  try {
    foreach ($argv as $file) {
      if (file_exists($file)) {
        $file_cwd = dirname($file);
        $value = Yaml::parse($file);

        // Check imports
        if (isset($value['imports'])) {
          foreach ($value['imports'] as $import) {
            foreach ($import as $type => $glob) {
              $matches = glob($file_cwd . DIRECTORY_SEPARATOR . $glob);
              foreach ($matches as $imported_file) {
                $imported_value = Yaml::parse($imported_file);
                $value = array_merge_recursive($value, $imported_value);
              }
            }
          }
        }

        if (isset($opts['format']) && $opts['format'] == 'json') {
          echo json_encode($value, JSON_PRETTY_PRINT);
        } else {
          print_r($value);
        }
      }
    }
  } catch (ParseException $e) {
    printf("Unable to parse the YAML string: %s", $e->getMessage());
  }
}
