<?php
    $database = connectToDB();

    $title = $_POST["title"];
    $content = $_POST["content"];
    $user_id = $_SESSION["user"]["id"];
    $image = $_FILES["image"];


    if ( empty( $title) || empty( $content)){
        $_SESSION["error"] = "All fields are required";
        header("location: /manage-posts-add");
        exit;
    // make sure passwords match
    }

    //trigger file upload
    // make sure image is not empty
    if (!empty($image)){
        //where is the upload folder
        $target_folder = "uploads/";
        //add the image name to the upload folder path
        //YYYYMMDDHHmmssvvv
        $target_path = $target_folder . date( "YmdHisv" ) . basename($image["name"]);
        
        // move the file to the uploads folder
        move_uploaded_file($image["tmp_name"] , $target_path);
    }
        
            $sql = "INSERT INTO posts (`title`, `content`, `image`, `user_id`) VALUES (:title, :content, :image, :user_id)";
            // 6.2 prepare
            $query = $database->prepare( $sql );
            // 6.3 execute
            $query->execute([
                "title" => $title,
                "content" => $content,
                "image" => isset($target_path) ? $target_path : "",
                "user_id" => $user_id
            ]);

            // 7. set success message
            $_SESSION["success"] = "Post created successfully";


            // 8. redirect to manage users.php
            header("Location: /manage-posts");
            exit;


 
    /*
    
        
        - make sure the email provided does not exist in the system

        TODO : 4. create the user account. Assign the role to the user
        role options :
            - user
            - editor
            - admin

        TODO : 5. Redirect back to the /manage-users page
    */
?>