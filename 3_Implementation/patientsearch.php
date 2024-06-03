<!DOCTYPE html>
 <?php
 require_once "models/Patient.php";
 require_once "models/Doctor.php";
 ?>
<html>
<head>
	<title>Patient Details</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
<?php
include("doctorFunctions.php");
require_once 'db-conn.php';
global $con;
if(isset($_POST['patient_search_submit']))
{
	$result = Patient::searchPatients($_POST['search']);
    if ($result){
    echo "<div class='container-fluid' style='margin-top:50px;'>
    <div class='card'>
    <div class='card-body' style='background-color:#342ac1;color:#ffffff;'>
    <table class='table table-hover'>
    <thead>
      <tr>
        <th scope='col'>#</th>
        <th scope='col'>Full Name</th>
        <th scope='col'>Gender</th>
        <th scope='col'>Email</th>
        <th scope='col'>Telephone</th>
      </tr>
    </thead>
    <tbody>";
    $cnt = 1;
    foreach ($result as $row) {
        echo "<tr>
        <td>".$cnt."</td>
        <td>".$row['name']." ".$row['surname']."</td>
        <td>".$row['gender']."</td>
        <td>".$row['email']."</td>
        <td>".$row['telephone']."</td>
        </tr>";
    }
	echo "</tbody></table><center><a href='receptionist-panel.php' class='btn btn-light'>Back to dashboard</a></div></center></div></div></div>";
}
  }
	
?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> 
</body>
</html>