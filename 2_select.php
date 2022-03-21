<?php

require_once('./dbconfig.php');


if ($_SERVER["REQUEST_METHOD"] === "POST") {
          $data = array();

          try {
                    $conn = new PDO("sqlsrv:server=$dbServer ; Database = $database", $dbUsername, $dbPassword);
                    $query = $conn->prepare('SELECT * FROM users');
                    $query->execute();

                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                              array_push($data, $row);
                    }

                    echo json_encode($data);
                    unset($conn);
          } catch (PDOException $e) {
                    echo ($e->getMessage());
          }
}
