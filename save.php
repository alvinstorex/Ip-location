<?php
header("Content-Type: application/json");
$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
  $file = "logs.json";
  $oldData = [];

  if (file_exists($file)) {
    $oldData = json_decode(file_get_contents($file), true);
    if (!is_array($oldData)) $oldData = [];
  }

  $oldData[] = $data;

  file_put_contents($file, json_encode($oldData, JSON_PRETTY_PRINT));
  echo json_encode(["status" => "success"]);
} else {
  echo json_encode(["status" => "error", "message" => "No data received"]);
}
?>