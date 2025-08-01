<?php
session_start();
$FLAG = "CTF{sql_1ns3rt_1nj3ct10n_s0_e4sy}";


if (!isset($_SESSION["username"]))
{
    header("Location: ../templates/login.html");
}

if ($_SESSION["username"] === "admin")
{
    echo "hello admin!" . "<br>";
    echo "FLAG: " . $FLAG;
}else{
    echo "hello " . $_SESSION["username"] . "!" ."<br>";
}