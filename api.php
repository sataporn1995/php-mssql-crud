<?php

require_once('./dbconfig.php');

try {
    $conn = new PDO("sqlsrv:server=$server;database=$database", $username, $password);
    // POST Request method
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $req =  (object)json_decode(file_get_contents("php://input"));
        $data = array();

        // C = Create ADD USER
        if ($req->router == "/add-user") {
            $query = $conn->prepare("INSERT INTO users VALUES (:name, GETDATE())");
            $query->execute([":name" => $req->name]);

            echo json_encode(["state" => true, "msg" => "Insert successfully."]);
        }
        // R = Read GET ALL USERS
        else if ($req->router == "/get-all-users") {
            $query = $conn->prepare('SELECT * FROM users');
            $query->execute();

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                array_push($data, $row);
            }

            echo json_encode($data);
        }
        // U = Update EDIT USER
        else if ($req->router == "/edit-user") {
            $query = $conn->prepare("UPDATE users SET name=:name WHERE id=:id");
            $query->execute([":name" => $req->name, ":id" => $req->id]);

            echo json_encode(["state" => true, "msg" => "Updated."]);
        }
        // D = Delete DELETE USER
        else if ($req->router == "/delete-user") {
            $query = $conn->prepare("DELETE FROM users WHERE id=:id");
            $query->execute([":id" => $req->id]);

            echo json_encode(["state" => true, "msg" => "Deleted."]);
        }
    }

    // GET Request method
    else if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $req =  (object)$_GET;
        $data = array();
    }
} catch (PDOException $error) {
    echo json_encode(["error" => $error->getMessage()]);
}
