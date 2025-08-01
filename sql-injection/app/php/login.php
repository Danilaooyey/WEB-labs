<?php
session_start();

$db_host = "db";
$db_user = "root";
$db_password = "monster";
$db_name = "monster";


if (isset($_POST["username"]) && isset($_POST["password"]))
{
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (strlen($username) > 0 && strlen($password) > 0)
    {
        try
        {
            $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        }catch(PDOException $exception){
            print_r($exception->getMessage());
        }       
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute([
            "username" => $username
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user || $password != $user["password"])
        {
            http_response_code(401);
            echo "username or password incorected";
            exit();
        }

        $_SESSION["username"] = $username;
        header("Location: home.php");
        exit();

    }
    http_response_code(401);
    echo "username or password is empty!";
    exit();
}
http_response_code(441);
echo "exist username or password!";



