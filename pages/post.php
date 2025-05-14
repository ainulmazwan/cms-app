<?php
    $database = connectToDB();
    
    $id = $_GET["id"];
    // load user data by id
    // sql
    $sql = "SELECT 
            posts.*, users.name
            FROM posts
            JOIN users 
            ON posts.user_id = users.id
            where posts.id = :id";
    // prepare
    $query = $database->prepare($sql);
    // execute
    $query -> execute([
      "id" => $id
    ]);
    // fetch
    $post = $query->fetch();

?>
<?php require "parts/header.php"; ?>
    <div class="container mx-auto my-5" style="max-width: 500px;">
      <h1 class="h1 mb-4 text-center"><?php echo $post["title"];   ?></h1>
      <h4 class="text-center"><?= $post["name"]?> </h4>
      <p>
      <?php 
        /*
          $content = "1,2,3,4,5";
          $content_array = explode(",", $content);
          $content_array = [1, 2, 3, 4, 5];
        */
        /*
        $content = $post["content"];
        $content_array = explode("\n", $content);
        foreach($content_array as $paragraph){
          echo "<p>$paragraph</p>";
        };
        */

        echo nl2br($post["content"]);
      ?>
      </p>
      <div class="text-center mt-3">
        <a href="/manage-posts" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back</a
        >
      </div>
    </div>

<?php require "parts/footer.php"; ?>
