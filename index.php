<?php
  session_start();

  require "includes/functions.php";

  $path = ($_SERVER["REQUEST_URI"]);
  
  // once figure out path, load relevent content based on path
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
    
    default:
      require "pages/home.php";
      break;
  }
?>