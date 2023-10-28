<!-- ******************** -->
<!-- ***START SESSION**** -->
<!-- ******************** -->
<?php
session_name("admin_session");
session_start();
include('../includes/dbconnection.php');
?>

<!-- ******************** -->
<!-- ***** PHP CODE ***** -->
<!-- ******************** -->
<?php

// Check if the admin is logged in; redirect to the admin login page if not
if (!isset($_SESSION['aid'])) {
    header('Location: dashboard.php');  // Redirect to the admin login page
    exit();
}
$sql = "SELECT * FROM user WHERE utype = 'Owner' "; // Replace 'user' with your user table name
$result = mysqli_query($con, $sql);

// if ($result) {
//     // Display a table to list user profiles
//     echo '<table class="table table-hover table-striped table-bordered">';
//     echo '<tr><th>User ID</th><th>Name</th><th>Email</th><th>User Type</th><th>Phone</th><th>Date Created</th></tr>';

//     while ($row = mysqli_fetch_assoc($result)) {
//         echo '<tr>';
//         echo '<td>' . $row['uid'] . '</td>';
//         echo '<td>' . $row['uname'] . '</td>';
//         echo '<td>' . $row['uemail'] . '</td>';
//         echo '<td>' . $row['utype'] . '</td>';
//         echo '<td>' . ($row['uphone'] ? $row['uphone'] : 'N/A') . '</td>';
//         echo '<td>' . date("Y-m-d", strtotime($row['created_at'])) . '</td>';
//         echo '</tr>';
//     }

//     echo '</table>';
// } else {
//     echo "Error: " . mysqli_error($con);
// }

?>

<!-- ******************** -->
<!-- **** START HTML **** -->
<!-- ******************** -->
<?php
include('includes/header.php');
include('includes/nav.php');
// include('users/user_verify.php');

?>
<div class="container-fluid">
  <div class="row">
<?php include('includes/sidebar.php');?>
<section class="col-sm-10 py-5 dashboard">
<h4>
    Owners
</h4>
<table class="table table-hover table-striped table-bordered" id='datatable'>
<thead>

    <tr><th>User ID</th><th>Name</th><th>Email</th>
    <!-- <th>User Type</th> -->
    <th>Phone</th><th>Date Created</th></tr>
</thead>
<tbody>
    <?php
      while ($row = mysqli_fetch_assoc($result)) {
          echo '<tr>';
          echo '<td>' . $row['uid'] . '</td>';
          echo '<td>' . $row['uname'] . '</td>';
          echo '<td>' . $row['uemail'] . '</td>';
          //   echo '<td>' . $row['utype'] . '</td>';
          echo '<td>' . ($row['uphone'] ? $row['uphone'] : 'N/A') . '</td>';
          echo '<td>' . date("Y-m-d", strtotime($row['created_at'])) . '</td>';
          echo '</tr>';
      }
?>
</tbody>


    
    <!-- </div> -->
    </section>
</div>
</div>
<?php include('includes/footer.php')?>
<script>
        $('#datatable').dataTable({});

</script>