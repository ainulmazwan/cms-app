<?php
    //connect to database
    function connectToDB(){
        $host = "127.0.0.1";
        $database_name = "simpleCMS"; // connect to which database
        $database_user = "root";
        $database_password = "";
        
        // 2. connect PHP with MySQL database
        // PDO (PHP database object)
        $database = new PDO(
            "mysql:host=$host;dbname=$database_name",
            $database_user, //username
            $database_password //password
        );
        return $database;
    }

    /*
        get user data by email
        Input:
        Output:
    */
    function getUserByEmail($email){

        $database = connectToDB();

        // 5. create a user account
        // 5.1 SQL command
        $sql = "SELECT * FROM users WHERE email = :email";
        // 5.2 prepare
        $query = $database->prepare($sql);

        // 5.3 execute
        $query -> execute([
            "email" => $email
            
        ]);

        $user = $query->fetch();
        return $user;
    }

    /*  check if user is logged in
        if user logged in, return true
        if user not logged in, return false
    */
    function isUserLoggedIn(){
        return isset($_SESSION["user"]);
    }
    

    function isAdmin(){
        // check if user session is set or not
        if (isset($_SESSION["user"]) ){
            // check if user is admit
            if ($_SESSION["user"]["role"]==="admin"){
                    return true;
            }
        }
    }
    function isEditor(){
        return isset($_SESSION["user"]) && ($_SESSION["user"]["role"] === "admin" || $_SESSION["user"]["role"] === "editor") ? true : false;
    }
?>