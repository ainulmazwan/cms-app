<?php 
    // 1. connect to database
    $database = connectToDB();

    // 2. get the data from the form
    $title = $_POST["title"];
    $content = $_POST["content"];
    $status = $_POST["status"];
    $id = $_POST["id"];
    $image = $_FILES["image"];

    // 3. check error
    if (empty($title) || empty($content) || empty($status)){
        $_SESSION["error"] = "Please fill up all the fields";
        header("Location: /manage-posts-edit?id=" . $id);
        exit;
    }

    if (!empty($image["name"])){
        $target_folder = "uploads/";

        $target_path = $target_folder . date( "YmdHisv" ) . "_" . basename($image["name"]);

        move_uploaded_file($image["tmp_name"] , $target_path);

        // 4. update post
        $sql = "UPDATE posts set title = :title, content = :content, status = :status, image = :image WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute([
            "title" => $title,
            "content" => $content,
            "status" => $status,
            "image" => $target_path,
            "id" => $id
        ]);
    }else{
        //update the post without image
        $sql = "UPDATE posts set title = :title, content = :content, status = :status WHERE id = :id";
        $query = $database->prepare($sql);
        $query->execute([
            "title" => $title,
            "content" => $content,
            "status" => $status,
            "id" => $id
        ]);
    }

    

    // 5. redirect
    $_SESSION["success"] = "Post has been updated";
    header("Location: /manage-posts");
    exit;
?>