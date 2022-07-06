<?php

require_once('./dbconfig.php');

$req =  (object)json_decode(file_get_contents("php://input"));
$data = array();
if ($_SERVER["REQUEST_METHOD"] === "POST") {

          // C = Create ADD USER
          if ($req->router == "/add-user") {
                    try {
                              $conn = new PDO("sqlsrv:server=$dbServer ; Database = $database", $dbUsername, $dbPassword);
                              $query = $conn->prepare("INSERT INTO users VALUES (:name, GETDATE())");
                              $query->execute([":name" => $req->name]);

                              echo json_encode(["state" => true, "msg" => "Insert successfully."]);
                    } catch (PDOException $e) {
                              echo ($e->getMessage());
                    }
          }
          // R = Read GET ALL USERS
          else if ($req->router == "/get-all-users") {
                    try {
                              $conn = new PDO("sqlsrv:server=$dbServer ; Database = $database", $dbUsername, $dbPassword);
                              $query = $conn->prepare('SELECT * FROM users');
                              $query->execute();

                              while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                        array_push($data, $row);
                              }

                              echo json_encode($data);
                    } catch (PDOException $e) {
                              echo ($e->getMessage());
                    }
          }
          // U = Update EDIT USER
          else if ($req->router == "/edit-user") {
                    try {
                              $conn = new PDO("sqlsrv:server=$dbServer ; Database = $database", $dbUsername, $dbPassword);
                              $query = $conn->prepare("UPDATE users SET name=:name WHERE id=:id");
                              $query->execute([":name" => $req->name, ":id" => $req->id]);

                              echo json_encode(["state" => true, "msg" => "Updated."]);
                    } catch (PDOException $e) {
                              echo ($e->getMessage());
                    }
          }
          // D = Delete DELETE USER
          else if ($req->router == "/delete-user") {
                    try {
                              $conn = new PDO("sqlsrv:server=$dbServer ; Database = $database", $dbUsername, $dbPassword);
                              $query = $conn->prepare("DELETE FROM users WHERE id=:id");
                              $query->execute([":id" => $req->id]);

                              echo json_encode(["state" => true, "msg" => "Deleted."]);
                    } catch (PDOException $e) {
                              echo ($e->getMessage());
                    }
          }
}
