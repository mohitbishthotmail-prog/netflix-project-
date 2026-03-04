<style>
 .sidebar 
	{
      height:100vh;
      background-color: #343a40;
      color: #fff;
      padding-top: 20px;
    }</style>

<?php include('sidebar.php');
?>
<main class="dashboard-content">
  <h1 class="mb-4 text-center">Welcome to Dashboard 👋</h1>

  <!-- Dashboard Cards -->
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card text-white bg-primary shadow-sm">
        <div class="card-body d-flex flex-column align-items-start">
          <h5 class="card-title"><i class="bi bi-people-fill me-2"></i>Total Users</h5>
          <p class="card-text fs-3 fw-bold">1,245</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-white bg-success shadow-sm">
        <div class="card-body d-flex flex-column align-items-start">
          <h5 class="card-title"><i class="bi bi-images me-2"></i>Photos Uploaded</h5>
          <p class="card-text fs-3 fw-bold">320</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-white bg-danger shadow-sm">
        <div class="card-body d-flex flex-column align-items-start">
          <h5 class="card-title"><i class="bi bi-exclamation-triangle me-2"></i>Pending Requests</h5>
          <p class="card-text fs-3 fw-bold">15</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Latest Activity Feed -->
 <div class="card mt-5 shadow-sm mb-5 translucent-card">
  <div class="card-body">
    <h5 class="card-title">
      <i class="bi bi-clock-history me-2"></i>Latest Activity
    </h5>
    <ul class="list-group list-group-flush translucent-list">
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <span>User John signed up</span>
        <small class="text-muted">2 mins ago</small>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <span>Photo uploaded by Mary</span>
        <small class="text-muted">10 mins ago</small>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <span>Pending request from Admin</span>
        <small class="text-muted">1 hour ago</small>
      </li>
    </ul>
  </div>
</div>
</main>
<?php include('footer.php');
?>
</body>
</html>
