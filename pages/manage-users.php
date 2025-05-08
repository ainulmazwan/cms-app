<?php

    if (!isAdmin()){
      header("Location: /dashboard");
      exit;
    }

    $database = connectToDB();

    $sql = "SELECT * FROM users";
    $query = $database->prepare($sql);
    $query->execute();
    $users = $query->fetchAll();
?>
<?php require "parts/header.php"; ?>


    <div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Users</h1>
        <div class="text-end">
          <a href="/manage-users-add" class="btn btn-primary btn-sm"
            >Add New User</a
          >
        </div>
      </div>
      <div class="card mb-2 p-4">
      <?php require "parts/message_success.php" ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col" class="text-end">Actions</th>
            </tr>
          </thead>
          <!-- foreach to display data -->
          <tbody>
            <?php foreach ($users as $index => $user) { ?>
            <tr>
              <th scope="row"><span class="ms-2 text-start"><?php echo $user["id"]   ?></span></th>
              <td><span class="ms-2 text-start"><?php echo $user["name"]   ?></span></td>
              <td><span class="ms-2 text-start"><?php echo $user["email"]   ?></span></td>
              <td><span 
                <?php if ($user["role"]=="user"): ?>
                  class="badge bg-success"
                <?php elseif ($user["role"]=="editor"): ?>
                  class ="badge bg-info"
                <?php else:?>
                  class = "badge bg-primary"
                <?php endif; ?>
              ><?php echo $user["role"]  ?></span></td>
              
              <td class="text-end">
                <div class="buttons d-flex justify-content-around">
                  <!-- edit user button -->
                  <a
                    href="/manage-users-edit?id=<?= $user['id']; ?>"
                    class="btn btn-success btn-sm me-2"
                    ><i class="bi bi-pencil"></i
                  ></a>
                  <!-- update password button -->
                    <a
                      href="/manage-users-changepwd?id=<?= $user['id']; ?>"
                      class="btn btn-warning btn-sm me-2"
                      ><i class="bi bi-key"></i
                    ></a>
                  
                  <!-- Button to trigger delete confirmation modal -->
                  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#userDeleteModal-<?php echo $user["id"];   ?>">
                     <i class="bi bi-trash"></i>
                  </button>
                  <!-- delete form -->
                  <div class="modal fade" id="userDeleteModal-<?php echo $user["id"];   ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to delete this user?</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                          <p>You are currently trying to delete this user : <?php echo $user["email"];   ?></p>
                          <p>This action cannot be reversed </p>
                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <form method="POST" action="/user/delete">
                            <input type="hidden" name="id" value="<?php echo $user["id"] ?>"/>
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
            <?php } ?>
            
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
