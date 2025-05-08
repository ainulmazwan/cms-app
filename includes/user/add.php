<?php
    $database = connectToDB();

    // todo : 2. get all data from the form using $_POST
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $role = $_POST["role"];

    /*
        TODO : 3. error checking
        - make sure all fields not empty
    */
    if ( empty( $name) || empty( $email) || empty($password) || empty($confirm_password) || empty($role) ){
        $_SESSION["error"] = "All fields are required";
        header("location: /manage-users-add");
        exit;
    // make sure passwords match
    }else if ($password!== $confirm_password) {
        $_SESSION["error"] = "Passwords do not match";
        header("location: /manage-users-add");
        exit;
    }else{
        $user = getUserByEmail($email);
        // check if user exist
        if($user){
            $_SESSION["error"] = "Email already exists";
            header("location: /manage-users-add");
            exit;
        }else{
            // 6. create a user account
            // 6.1 SQL command
            $sql = "INSERT INTO users (`name`,`email`,`password`, `role`) VALUES (:name, :email, :password, :role)";
            // 6.2 prepare
            $query = $database->prepare( $sql );
            // 6.3 execute
            $query->execute([
                "name" => $name,
                "email" => $email,
                "password" => password_hash( $password, PASSWORD_DEFAULT ),
                "role" => $role
            ]);

            // 7. set success message
            $_SESSION["success"] = "User created successfully";


            // 8. redirect to manage users.php
            header("Location: /manage-users");
            exit;
        }

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