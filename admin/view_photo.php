<?php
session_start();
ob_start();
include('sidebar.php');

$sql="select * from category";
$query=mysqli_query($conn,$sql) or die("Check the Query");

if(!isset($_SESSION['loged'])) {
    header("location:login.php");
    exit();
}
?>


<main class="col-md-9 ml-sm-auto col-lg-10 dashboard-content">
  <br>
  <br>
  <br>
  <div class="container">
    <div class="table-wrapper card shadow-sm p-4 translucent-card">
      <h4 class="mb-4 text-light"><i class="bi bi-grid me-2"></i> MOVIES POSTER </h4>

      <div class="table-responsive">
        <table class="table translucent-table table-hover align-middle">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Movie</th>
              <th scope="col">Category</th>
              <th scope="col">Movie Poster</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $sr=1;
            while($row=mysqli_fetch_array($query)) { ?>
              <tr>
                <td><?php echo $sr++;?></td>
                <td><?php echo $row['movie'];?></td>
                <td><?php echo $row['category'];?></td>
                <td>
                  <img src="upload/<?php echo $row['image'];?>" 
                       class="img-thumbnail rounded shadow-sm" 
                       style="height: 80px; width: 80px; object-fit: cover;">
                </td>
                <td class="action-btns">
                  <a href="delete.php?ids=<?php echo $row['id'];?>" 
                     class="btn btn-sm btn-danger">
                     <i class="bi bi-trash-fill"></i> 
                  </a>
				  <a href="update.php?id=<?php echo $row['id']; ?>" 
					   class="btn btn-sm btn-primary">
					   <i class="bi bi-pencil-square"></i> 
				  </a>

                </td>
				
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<?php include('footer.php'); ?>
</body>
</html>
