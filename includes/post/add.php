<?php
    $database = connectToDB();

    $title = $_POST["title"];
    $content = $_POST["content"];
    $user_id = $_SESSION["user"]["id"];
    
    if ( empty( $title) || empty( $content)){
        $_SESSION["error"] = "All fields are required";
        header("location: /manage-users-add");
        exit;
    // make sure passwords match
    }
    else{
        
            $sql = "INSERT INTO posts (`title`,`content`, `user_id`) VALUES (:title, :content, :user_id)";
            // 6.2 prepare
            $query = $database->prepare( $sql );
            // 6.3 execute
            $query->execute([
                "title" => $title,
                "content" => $content,
                "user_id" => $user_id
            ]);

            // 7. set success message
            $_SESSION["success"] = "Post created successfully";


            // 8. redirect to manage users.php
            header("Location: /manage-posts");
            exit;
        }

 
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