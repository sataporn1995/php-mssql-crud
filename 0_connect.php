<?php

require_once('./dbconfig.php');

$data = array();

try {
          $conn = new PDO("sqlsrv:server=$server ; Database = $database", $username, $password);

          echo json_encode(["msg" => "connected"]);
          unset($conn);
} catch (PDOException $e) {
          echo (["error" => $e->getMessage()]);
}
