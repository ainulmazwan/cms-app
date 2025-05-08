<?php 
    $database = connectToDB();

    $sql = "SELECT * FROM posts";
    $query = $database->prepare($sql);
    $query->execute();
    $students = $query->fetchAll();

    $id = $_POST["id"];

    $sql = "DELETE FROM posts WHERE id = :id";
    $query = $database->prepare( $sql );
    $query->execute([
        "id" => $id
    ]);
    header("location: /manage-posts");
    exit;
?>