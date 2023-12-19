<?php 
session_start();
require '../config/config.php';

if(empty( $_SESSION['user_id']) && empty($_SESSION['logged_in'])){
  header('Location: login.php/');
}


?> 

<?php include('header.html'); ?>


    <!-- Main content -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Blog Listings</h3>
        </div>
        <?php 
         $stmt =$pdo->prepare("SELECT * FROM posts ORDER BY id DESC");
         $stmt->execute();
         $result = $stmt->fetchAll();
        ?>
        <!-- /.card-header -->
        <div class="card-body">
          <div>
            <a href="add.php" class="btn btn-success">New Blog</a>
          </div>
          <br>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">ID</th>
                <th>Title</th>
                <th>Content</th>
                <th style="width: 40px">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              if($result){
                $i=1;
                foreach($result as $value){
              ?>
              <tr>
                <td><?php echo $i;?></td>
                <td>
                  <?php echo $value['title'] ?>
                </td>
                <td>
                <?php echo substr($value['content'],0,50) ?>
                </td>
                <td>
                 <div class="btn-group">
                    <div class="container">
                      <a href="edit.php?id=<?php echo $value['id'] ?>" type="button" class="btn btn-warning">Edit</a>
                    </div>
                    <div class="container">
                      <a href="delete.php?id=<?php echo $value['id'] ?>" onclick="return confirm('Are you sure you want to delete this item?')" type="button" class="btn btn-danger">Delete</a>
                    </div>
                 </div>
                </td>
              </tr>
              <?php
              $i++;
                }
              }
              ?>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
   \

    <?php include('footer.html') ?>

