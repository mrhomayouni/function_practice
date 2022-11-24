<?php
require "core.php";

function get_user_by_name(string $username, string $email): bool|array
{
    global $conn;

    $sql = "SELECT * FROM `user` WHERE `username`=:username OR `email`=:email";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue("username", $username);
    $stmt->bindValue("email", $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function add_user(string $FullName, string $UserName, string $password, string $email)
{
    global $conn;

    $sql = "INSERT INTO `user`( `fullname`, `username`, `password`, `email`, `create_at`) 
VALUES (:fullname,:username,:password,:email,:create_at)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue("fullname", $FullName);
    $stmt->bindValue("username", $UserName);
    $stmt->bindValue("password", md5($password));
    $stmt->bindValue("email", $email);
    $stmt->bindValue("create_at", time());
    if ($stmt->execute()) {
        return true;
    }
}
