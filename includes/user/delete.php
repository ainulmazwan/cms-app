<?php 
    $database = connectToDB();

    $sql = "SELECT * FROM users";
    $query = $database->prepare($sql);
    $query->execute();
    $students = $query->fetchAll();

    $id = $_POST["id"];

    $sql = "DELETE FROM users WHERE id = :id";
    $query = $database->prepare( $sql );
    $query->execute([
        "id" => $id
    ]);
    header("location: /manage-users");
    exit;
?>