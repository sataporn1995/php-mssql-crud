<?php

require_once('./dbconfig.php');

$data = array();

try {
          $conn = new PDO("sqlsrv:server=$dbServer ; Database = $database", $dbUsername, $dbPassword);
          $query = $conn->prepare("UPDATE users SET name=:name WHERE id=MAX(id)");
          $query->execute([":name" => "XYZ"]);

          echo json_encode(["state" => true, "msg" => "Updated."]);
          unset($conn);
} catch (PDOException $e) {
          echo ($e->getMessage());
}
