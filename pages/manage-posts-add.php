<?php require "parts/header.php"; ?>
    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Add New Post</h1>
      </div>
      <div class="card mb-2 p-4">
        <form action="/post/add" method="POST"  enctype="multipart/form-data">
          <div class="mb-3">
            <label for="post-title" class="form-label">Title</label>
            <input name="title" type="text" class="form-control" id="post-title" />
          </div>
          <div class="mb-3">
            <label for="post-content" class="form-label">Content</label>
            <textarea
              class="form-control"
              id="post-content"
              rows="10"
              name="content"
            ></textarea>
          </div>
          <div class="mb-3">
            <input type="file" name="image" accept="image/*">
          </div>  
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Add</button>
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
