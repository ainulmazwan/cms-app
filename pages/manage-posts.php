<?php
    $database = connectToDB();

    $user_id = $_SESSION["user"]["id"];

    /* 
      use ORDER BY to sort by column
      use ASC to sort by ascending order (lowest value first)
      use DESC to sort by descending order (highest value first)
    */
  /*
  
  */
  if (isEditor()){
    $sql = "SELECT posts.*, users.name 
            FROM posts 
            JOIN users 
            ON posts.user_id = users.id 
            ORDER BY posts.id DESC";
    $query = $database->prepare($sql);
    $query->execute();
  }else{
    // version 1 (recommended)
    $sql = "SELECT posts.*, users.name
            FROM posts 
            JOIN users 
            ON posts.user_id = users.id 
            WHERE user_id = :user_id  
            ORDER BY posts.id DESC";
    $query = $database->prepare($sql);
    $query->execute([
      "user_id" => $user_id
    ]);
  }
    // version 2 (not recommended)
    /* 
    $sql = "SELECT * FROM posts WHERE user_id = " . $user_id . "ORDER BY id ASC";
    $query = $database->prepare($sql);
    $query->execute();
    */
    $posts = $query->fetchAll();

?>
<?php require "parts/header.php"; ?>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Posts</h1>
        <div class="text-end">
          <a href="/manage-posts-add" class="btn btn-primary btn-sm"
            >Add New Post</a
          >
        </div>
      </div>
      <?php require "parts/message_success.php"; ?>
      <div class="card mb-2 p-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col" style="width: 40%;">Title</th>
              <th scope="col">Author</th>
              <th scope="col">Status</th>
              <th scope="col" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
         
              <?php foreach ($posts as $index => $post) : ?>
                <?php if ($post["user_id"]==$_SESSION["user"]["id"]  || isEditor()) : ?>
                <tr>
                  
                  <th scope="row"><?php echo $post["id"]   ?></th>
                  <td><?php echo $post["title"]   ?></td>
                  <td><?php echo $post["name"]   ?></td>
                  <td>
                  <?php if ($post["status"]=="pending") : ?>
                    <span class="badge bg-warning"><?php echo $post["status"] ?></span>
                  <?php else: ?>
                    <span class="badge bg-success"><?php echo $post["status"] ?></span>
                  <?php endif; ?>
                  </td>
                  <td class="text-end">
                    <div class="buttons">
                      <a
                        href="/post?id=<?php echo $post["id"] ?>"
                        target="_blank"
                        class="btn btn-primary btn-sm me-2 <?php echo ($post["status"] === 'pending' ? "disabled" : ""); ?>"
                        ><i class="bi bi-eye"></i
                      ></a>
                      <a
                        href="/manage-posts-edit?id=<?php echo $post["id"]; ?>"
                        class="btn btn-secondary btn-sm me-2"
                        ><i class="bi bi-pencil"></i
                      ></a>
                      <!-- Button to trigger delete confirmation modal -->
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#postDeleteModal-<?php echo $post["id"];   ?>">
                        <i class="bi bi-trash"></i>
                      </button>
                      <!-- delete form -->
                      <div class="modal fade" id="postDeleteModal-<?php echo $post["id"];   ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to delete this post?</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                              <p>You are currently trying to delete this post : <?php echo $post["title"];   ?></p>
                              <p>This action cannot be reversed </p>
                              
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <form method="POST" action="/post/delete">
                                <input type="hidden" name="id" value="<?php echo $post["id"] ?>"/>
                                <button class="btn btn-danger btn-sm"
                                ><i class="bi bi-trash"></i
                                ></button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            <tr>
          </tbody>
        </table>
      </div>
      <div class="text-center">
        <a href="/dashboard" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Dashboard</a
        >
      </div>
    </div>

<?php require "parts/footer.php"; ?>
