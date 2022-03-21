<?php

require_once('./dbconfig.php');

$data = array();

try {
          $conn = new PDO("sqlsrv:server=$dbServer ; Database = $database", $dbUsername, $dbPassword);
          $query = $conn->prepare("INSERT INTO users VALUES (:name, GETDATE())");
          $query->execute([":name" => "ABCD"]);

          echo json_encode(["state" => true, "msg" => "Insert successfully."]);
          unset($conn);
} catch (PDOException $e) {
          echo ($e->getMessage());
}
