<?php
    $database = connectToDB();

    $email = $_POST["email"];
    $password = $_POST["password"];

    // 4. check for error
    if (empty($email) || empty($password)){
        echo "All fields are required";
    }else{
        $user = getUserByEmail($email);

        // check if the user exists
        if ($user){
            // 6. check if the password is correct or not
            if (password_verify($password, $user["password"])){
                // 7. store the user data in the session storage to login the user
                $_SESSION["user"] = $user;

                header("Location: /dashboard");
            }else{
                echo "The password provided is incorrect";
            }
        }else{
            echo "The email provided does not exist";
        };
    };

?>