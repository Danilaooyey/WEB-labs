<?php
session_start();

$db_host = "db";
$db_user = "root";
$db_password = "monster";
$db_name = "monster";


if (isset($_POST["username"]) && isset($_POST["password"]))
{
    $username = str_replace('\'', '', $_POST["username"]);
    $password = str_replace('\'', '', $_POST["password"]);
    if (strlen($username) > 0 && strlen($password) > 0)
    {

        try
        {
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        }catch(PDOException $exception)
        {
            print_r($exception -> getMessage());
        }


        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute([
            "username" => $username
        ]);
        $user = $stmt -> fetch(PDO::FETCH_ASSOC);
        if($user)
        {
            http_response_code(401);
            echo "user already exists!";
            exit();
        }
        try{
            $sql = "INSERT INTO users (username, password) VALUES('$username', '$password')";
            $stmt = $pdo -> query($sql);
        }catch(PDOException $exception){
            http_response_code(500);
            exit();
        }
        
        header("Location: ../templates/login.html");
        exit();
    }
    http_response_code(401);
    echo "username or password is empty!";
    exit();
}
http_response_code(401);
echo "exist username or password!";