<!DOCTYPE html>
 <?php #include("loginPatient.php");?>
<html>
<head>
	<title>User Feedbacks</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
<?php
include("doctorFunctions.php");
require_once 'db-conn.php';
global $con;
if(isset($_POST['mes_search_submit']))
{
    $result = Feedback::searchFeedbacks($_POST['contact']);
  if(!$result){
    echo "<script> alert('No entries found! Please enter valid details'); 
          window.location.href = 'receptionist-panel.php#list-doc';</script>";
  } 
  else {
      echo "<div class='container-fluid' style='margin-top:50px;'>
    <div class='card'>
    <div class='card-body' style='background-color:#342ac1;color:#ffffff;'>
  <table class='table table-hover'>
    <thead>
      <tr>
        <th scope='col'>#</th>
        <th scope='col'>Full Name</th>
        <th scope='col'>Email</th>
        <th scope='col'>Date Created</th>
        <th scope='col'>Message</th>
      </tr>
    </thead>
    <tbody>";
    $cnt = 1;
      foreach ($result as $row){
          $patient=Patient::getPatient($row['patient_id']);
            echo "<tr>
            <td>".$cnt."</td>
            <td>".$patient['name']." ".$patient['surname']."</td>
            <td>".$patient['email']."</td>
            <td>".$row['date_created']."</td>
            <td>".$row['message']."</td>
            </tr>";
      }
    echo "</tbody>
        </table>
        <a href='receptionist-panel.php' class='btn btn-light'>Back to your Dashboard</a>
    </div>
    </div>
</div>
</div>";
  }
  }
	
?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> 
</body>
</html>