<?php
  session_start();

  require "includes/functions.php";

  $path = ($_SERVER["REQUEST_URI"]);
  
  // once figure out path, load relevent content based on path

  // remove all query string (?) from url
  $path = parse_url( $path, PHP_URL_PATH );

  switch ($path) {
    case '/login':
      require "pages/login.php";
      break;
    case '/signup':
      require "pages/signup.php";
      break;
    case '/logout':
      require "pages/logout.php";
      break;
    case '/dashboard':
      require "pages/dashboard.php";
      break;
    case '/auth/signup':
      require "includes/auth/do_signup.php";
      break;
    case '/auth/login':
      require "includes/auth/do_login.php";
      break;
    case '/manage-posts':
      require "pages/manage-posts.php";
      break;
    case '/manage-posts-add':
      require "pages/manage-posts-add.php";
      break;
    case '/manage-posts-edit':
      require "pages/manage-posts-edit.php";
      break;
    case '/manage-users':
      require "pages/manage-users.php";
      break;
    case '/manage-users-add':
      require "pages/manage-users-add.php";
      break;
    case '/manage-users-edit':
      require "pages/manage-users-edit.php";
      break;
    case '/manage-users-changepwd':
      require "pages/manage-users-changepwd.php";
      break;
    case '/post':
      require "pages/post.php";
      break;
    // setup action route for add user
    case '/user/add':
      require "includes/user/add.php";
      break;
    //setup action route for delete user
    case '/user/delete':
      require "includes/user/delete.php";
      break;
    // setup action route for change password
    case '/user/changepwd' :
      require "includes/user/changepwd.php";
      break;
    // setup action route for update user
    case '/user/update' :
      require "includes/user/update.php";
      break;
    case '/post/add' :
      require "includes/post/add.php";
      break;
    case '/post/edit' :
      require "includes/post/edit.php";
      break;
    case '/post/delete' :
      require "includes/post/delete.php";
      break;

    
    
    default:
      require "pages/home.php";
      break;
  }
?>