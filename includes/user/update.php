<?php 
    // 1. connect to database
    $database = connectToDB();

    // 2. get the data from the form
    $name = $_POST["name"];
    $role = $_POST["role"];
    $id  = $_POST["id"];

    // 3. check error
    if (empty($id) || empty($name) || empty($role)){
        $_SESSION["error"] = "Please fill up all the fields";
        header("Location: /manage-users-edit?id=" . $id);
        exit;
    }

    // 4. update user
    $sql = "UPDATE users set name = :name, role = :role WHERE id = :id";
    $query = $database->prepare($sql);
    $query->execute([
        "name" => $name,
        "role" => $role,
        "id" => $id
    ]);

    // 5. redirect
    $_SESSION["success"] = "User has been updated";
    header("Location: /manage-users");
    exit;
?>