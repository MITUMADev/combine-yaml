<?php

  // Combine multiple YAML files into one

  $yaml_files = $_FILES['yaml-files']['tmp_name'];

  $combined_yaml = array();

  foreach ($yaml_files as $yaml_file) {

    $yaml = file_get_contents($yaml_file);

    $data = yaml_parse($yaml);

    $combined_yaml = array_merge($combined_yaml, $data);

  }

  $combined_yaml = yaml_emit($combined_yaml);

  header('Content-Type: text/plain');

  header('Content-Disposition: attachment; filename="combined.yaml"');

  echo $combined_yaml;

?>

