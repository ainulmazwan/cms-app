<?php
    $database = connectToDB();
    
    $id = $_GET["id"];
    // load user data by id
    // sql
    $sql = "SELECT * FROM posts where id = :id";
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
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit Post</h1>
      </div>
      <?php require ("parts/message_error.php") ?>
      <div class="card mb-2 p-4">
        <form action="/post/edit" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="post-title" class="form-label">Title</label>
            <input
              type="text"
              class="form-control"
              id="post-title"
              value="<?php echo $post["title"];   ?>"
              name="title"
            />
          </div>
          <div class="mb-3">
            <label for="post-content" class="form-label">Content</label>
            <textarea name="content" class="form-control" id="post-content" rows="10"><?= $post["content"]   ?></textarea
            >
          </div>
          <div class="mb-3">
            <label for="post-content" class="form-label">Status</label>
            <select class="form-control" id="post-status" name="status">
              
              <option value="pending" <?php echo ( $post["status"] === "pending" ? "selected" : "" ); ?>>Pending for Review</option>
              <option value="publish" <?php echo ( $post["status"] === "publish" ? "selected" : "" ); ?>>Publish</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Image</label>
            <div>
              <img src="/<?= $post['image']?>" class="img-fluid">
            </div>
            <input type="file" name="image" accept="image/*">
          </div>
          <div class="text-end">
            <input type="hidden" name="id" value="<?php echo $post["id"]; ?>" />
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      <div class="text-center">
      
        <a href="/manage-posts" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Posts</a
        >
      </div>
    </div>

<?php require "parts/footer.php"; ?>
