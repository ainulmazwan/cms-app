<?php
    // 1 connect to database
    $database = connectToDB();

    // 2 get data from form
    $id = $_POST["id"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // 3 check for error
    if (empty($password) || empty($confirm_password)){
        $_SESSION["error"] ="Please fill out all the fields";
        header("Location: /manage-users-changepwd?id=".$id);
        exit;
    }else if ($password !== $confirm_password){
        $_SESSION["error"] ="Passwords do not match";
        header("Location: /manage-users-changepwd?id=".$id);
        exit;
    }
    // 4 update password
    $sql = "UPDATE users set password = :password WHERE id = :id";
    $query = $database->prepare($sql);
    $query->execute([
    "password" => password_hash($password, PASSWORD_DEFAULT),
    "id" => $id
    ]);

    

    // 5 redirect
    $_SESSION["success"] = "User's password has been updated";
    header("Location: /manage-users");
    exit;
?>