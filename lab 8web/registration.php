<?php

header('Content-Type: application/json');

if (!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["lname"])
    && !empty($_POST["fname"]) && !empty($_POST["url"]) && !empty($_POST["date"])) {
    $email = $_POST["email"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $pass = $_POST["password"];
    $url = $_POST["url"];
    $date = $_POST["date"];
    $temp = 0;

    require_once "link.php";
            $stmt = $link->prepare("INSERT INTO users(name,surname,email,password,img,birthday)VALUES( ?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $fname, $lname, $email, $pass, $url, $date);
            /* execute query */
            $stmt->execute();

            /* Get the result */
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if ($row != null && $row['email'] != null) {
                session_start();
                $_SESSION['user'] = array(
                    'name' => $row['name'],
                    'surname' => $row['surname'],
                    'email' => $row['email']
                );
                $return = array(
                    'message' => "success"
                );
            } else {
                $return = array(
                    'errorMessage' => "Registration!"
                );
                http_response_code(401);
            }
            $stmt->close();
    } else {
        $return = array(
            'errorMessage' => "Login attempt denied."
        );
        http_response_code(403);
    }
    echo(json_encode($return));