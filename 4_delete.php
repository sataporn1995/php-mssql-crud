<?php

require_once('./dbconfig.php');

$data = array();

try {
          $conn = new PDO("sqlsrv:server=$dbServer ; Database = $database", $dbUsername, $dbPassword);
          $query = $conn->prepare("DELETE FROM users WHERE id=MAX(id)");
          $query->execute();

          echo json_encode(["state" => true, "msg" => "Deleted."]);
          unset($conn);
} catch (PDOException $e) {
          echo ($e->getMessage());
}
