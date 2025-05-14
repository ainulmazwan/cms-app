<?php

  $search_keyword = isset($_GET["search"]) ? $_GET["search"] : "";


  $database = connectToDB();

  $sql = "SELECT * FROM posts 
          WHERE status = 'publish'
          AND (title LIKE :keyword OR content LIKE :keyword) 
          ORDER BY id DESC";
  $query = $database->prepare($sql);
  $query->execute([
    "keyword"=>"%$search_keyword%"
  ]);

  //dangerous version
  /* 
  $sql = "SELECT * FROM posts 
          WHERE status = 'publish'
          AND (title LIKE '%".$search_keyword".' OR content LIKE '."$search_keyword".') 
          ORDER BY id DESC";
  $query = $database->prepare($sql);
  $query->execute();
  */
  $posts = $query->fetchAll();
?>

<?php require "parts/header.php"; ?>
  <body>

    <div class="container mx-auto my-5" style="max-width: 500px;">
      <h1 class="h1 mb-4 text-center">My Blog</h1>
      <!-- greeting message -->
      <?php if (isUserLoggedIn()): ?>
        <div class="d-flex gap-4">
          <p>Welcome back, <?= $_SESSION["user"]["name"]; ?></p>
          <a href="/dashboard">Go to dashboard</a>
        </div>
      <?php endif; ?>
      <!-- search -->
      <form method="GET" action="/" class="mb-2 d-flex align-items-center gap-2">
        <input type="text" name="search" class="form-control" placeholder="Type a keyword to search..." value="<?= $search_keyword?>">
        <button class="btn btn-primary"><i class="bi bi-search"></i></button>
        <a href="/" class="btn btn-dark">Reset</a>
      </form>

      <?php foreach ($posts as $post) : ?>
      <div class="card mb-2">
        <div class="card-image">
          <?php if (!empty($post["image"])) : ?>
            <img src="/<?= $post["image"]; ?> " class="img-fluid">
          <?php endif; ?>
        </div>
        <div class="card-body">
          <h5 class="card-title"><?= $post["title"]; ?></h5>
          <p class="card-text"><?= $post["content"]; ?></p>
          <div class="text-end">
            <a href="/post?id=<?= $post["id"]; ?>" class="btn btn-primary btn-sm">Read More</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
        
      
      <?php if (isUserLoggedIn()): ?>
        <div class="mt-4 d-flex justify-content-center gap-3">
          <a href="/logout" class="btn btn-link btn-sm">Log Out</a>
        </div>
      <?php else: ?>
        <div class="mt-4 d-flex justify-content-center gap-3">
        <a href="/login" class="btn btn-link btn-sm">Login</a>
        <a href="/signup" class="btn btn-link btn-sm">Sign Up</a>

        </div>
      <?php endif; ?>
    </div>

<?php require "parts/footer.php"; ?>
