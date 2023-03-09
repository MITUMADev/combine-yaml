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

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $yaml_files = $_FILES['yaml-files']['tmp_name'];
  
  if (empty($yaml_files)) {
    $error = 'Please select at least one YAML file.';
  } else {
    $combined_yaml = '';
    foreach ($yaml_files as $yaml_file) {
      $yaml_contents = file_get_contents($yaml_file);
      $combined_yaml .= $yaml_contents . "\n";
    }
    
    $combined_file_name = 'combined_yaml_' . date('YmdHis') . '.yaml';
    $combined_file_path = __DIR__ . '/' . $combined_file_name;
    
    file_put_contents($combined_file_path, $combined_yaml);
    
    $download_link = $combined_file_name;
  }
}

?>
