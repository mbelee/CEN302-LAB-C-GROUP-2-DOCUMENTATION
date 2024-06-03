<!DOCTYPE html>
<html>
<head>
    <title>Doctor Details</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
<?php
include("doctorFunctions.php");
require_once 'db-conn.php';
global $con;
if (isset($_POST['doctor_search_submit'])) {
    $doctors=Doctor::searchDoctors($_POST['search']);
    if ($doctors) {
        echo "<h3 class='text-center text-info'>Doctors</h3>
                <table class='table table-hover'>
                    <thead>Newdb.sql
                        <tr>
                            <th>#</th>
                            <th>Doctor Name</th>
                            <th>Doctor Specialty</th>
                            <th>Doctor Email</th>
                            <th>Doctor Telephone</th>
                        </tr>
                    </thead>
                    <tbody>";
        $cnt = 1;
        foreach ($doctors as $doctor) {
            echo "<tr>
                    <td>".$cnt."</td>
                    <td>".$doctor['name']." ".$doctor['surname']."</td>
                    <td>".$doctor['specialty']."</td>
                    <td>".$doctor['email']."</td>
                    <td>".$doctor['telephone']."</td>
                </tr>";
            $cnt++;
        }
    } else {
        echo "<div class='alert alert-danger'>No doctors found</div>";
    }
    echo "</tbody></table><a href='receptionist-panel.php' class='btn btn-light'>Back to dashboard</a></div></div></div></div>";
}


?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>
</body>
</html>