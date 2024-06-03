<!DOCTYPE html>
<?php
require_once "models/Doctor.php";
require_once "models/Checkup.php";
require_once "models/Feedback.php";
require_once "models/Message.php";
require_once "models/Patient.php";
require_once "models/MedicalRecords.php";
include('doctorLogin.php');
if (isset($_GET['cancel'])) {
    if (Checkup::deleteCheckup($_GET['ID'])) {
        echo "<script>alert('Appointment cancelled successfully!');</script>";
    } else {
        echo "<script>alert('Unable to process your request. Try again!');</script>";
    }
}
?>
<html lang="en">
<head>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <a class="navbar-brand" href="#"><i class="fa fa-hospital-o" aria-hidden="true"></i> Hospital Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <style>
            .btn-outline-light:hover {
                color: #25bef7;
                background-color: #f8f9fa;
                border-color: #f8f9fa;
            }
        </style>

        <style>
            .bg-primary {
                background: #F0F2F0; /* fallback for old browsers */
                background: -webkit-linear-gradient(to right, #000C40, #F0F2F0); /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to right, #000C40, #F0F2F0); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            }

            .list-group-item.active {
                z-index: 2;
                color: #fff;
                background: #F0F2F0;
                background: -webkit-linear-gradient(to right, #000C40, #F0F2F0);
                background: linear-gradient(to right, #000C40, #F0F2F0);
                border-color: #c3c3c3;
            }

            .text-primary {
                color: #342ac1 !important;
            }
        </style>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" method="post" action="../search.php">
                <input class="form-control mr-sm-2" type="text" placeholder="Search Checkup" aria-label="Search"
                       name="contact">
                <input type="submit" class="btn btn-primary" id="inputbtn" name="search_submit" value="Search">
            </form>
        </div>
    </nav>
</head>
<style type="text/css">
    button:hover {
        cursor: pointer;
    }

    #inputbtn:hover {
        cursor: pointer;
    }
</style>
<body style="padding-top:50px;">
<div class="container-fluid" style="margin-top:50px;">
    <h3 style="margin-left: 40%; padding-bottom: 20px;font-family:'IBM Plex Sans', sans-serif;"> Welcome
        &nbsp<?php echo Doctor::name($_POST['pid']) ?>  </h3>
    <div class="row">
        <div class="col-md-4" style="max-width:18%;margin-top: 3%;">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" href="#list-dash" id="list-dash-list"
                   role="tab"
                   aria-controls="home" data-toggle="list">Dashboard</a>
                <a class="list-group-item list-group-item-action" href="#list-app" id="list-app-list" role="tab"
                   data-toggle="list" aria-controls="home">Checkup Details</a>
                <a class="list-group-item list-group-item-action" href="#list-pres" id="list-pres-list" role="tab"
                   data-toggle="list" aria-controls="home">Medical History List</a>
                <a class="list-group-item list-group-item-action" href="#list-mes" id="list-mes-list" role="tab"
                   data-toggle="list" aria-controls="home">Messages</a>
            </div>
            <br>
        </div>
        <div class="col-md-8" style="margin-top: 3%;">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">

                            <div class="col-sm-4" style="left: 10%">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
                                        <h4 class="StepTitle" style="margin-top: 5%;"> View Checkups</h4>
                                        <script>
                                            function clickDiv(id) {
                                                document.querySelector(id).click();
                                            }
                                        </script>
                                        <p class="links cl-effect-1">
                                            <a href="#list-app" onclick="clickDiv('#list-app-list')">
                                                Checkups List
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4" style="left: 15%">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-file-powerpoint-o fa-stack-1x fa-inverse"></i> </span>
                                        <h4 class="StepTitle" style="margin-top: 5%;"> Medical Histories</h4>

                                        <p class="links cl-effect-1">
                                            <a href="#list-pres" onclick="clickDiv('#list-pres-list')">
                                                Medical Histories List
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="list-app" role="tabpanel" aria-labelledby="list-app-list">
                    <div class="container-fluid container-fullw bg-white">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Patient</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $cnt = 1;
                        foreach (Checkup::getCheckupsByDoctor($_SESSION['doctor_id']) as $row) {
                            $patient = Patient::getPatient($row['patient_id']);
                            $doctor = Doctor::getDoctor($row['doctor_id']);
                            $status = $row['date_created'] > date('Y-m-d') ? "Upcoming" : "Done";
                            echo "<tr>
                                <td>{$cnt}</td>
                                <td>{$patient['name']} {$patient['surname']}</td>
                                <td>{$patient['gender']}</td>
                                <td>{$patient['email']}</td>
                                <td>{$patient['telephone']}</td>
                                <td>{$patient['date_created']}</td>
                                <td>{$status}</td>
                                <td><a href='doctor-panel.php?ID={$row['id']}&cancel=update'</td>
                                </tr>";
                            $cnt++;
                        } ?>
                        </tbody>
                    </table>
                    <br>
                    </div>
                </div>
                <div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">
                    <div class="container-fluid container-fullw bg-white">
                    <table class="table table-hover">
                        <thead>
                        <tr>

                            <th scope="col">#</th>
                            <th scope="col">Patient</th>
                            <th scope="col">Appointment Date</th>
                            <th scope="col">Doctor</th>
                            <th scope="col">Bloodtype</th>
                            <th scope="col">Allergy</th>
                            <th scope="col">Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $cnt = 1;
                        foreach (MedicalRecords::getMedicalRecordsByDoctor($_SESSION['doctor_id']) as $row) {
                            $patient = Patient::getPatient($row['patient_id']);
                            $doctor = Doctor::getDoctor($row['doctor_id']);
                            echo "<tr>
                                <td>{$cnt}</td>
                                <td>{$patient['name']} {$patient['surname']}</td>
                                <td>{$row['date_created']}</td>
                                <td>{$doctor['name']} {$doctor['surname']}</td>
                                <td>{$row['bloodtype']}</td>
                                <td>{$row['allergy']}</td>
                                <td>{$row['details']}</td>
                                </tr>";
                        }
                        $cnt++;
                        ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="list-mes" role="tabpanel" aria-labelledby="list-mes-list">
                    <div class="container-fluid container-fullw bg-white">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">Patient Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Doctor Name</th>
                            <th scope="col">Read</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach (Message::getMessagesByReceiver(Doctor::getDoctor($_SESSION['pid'])['email']) as $row) {
                            $patient = Patient::getPatient($row['patient_id']);
                            $doctor = Doctor::getDoctor($row['doctor_id']);
                            $status = $row['mark_as_read'] == "no" ? "Unread" : "Read";
                            echo "<tr>
                                <td>{$patient['name']} {$patient['surname']}</td>
                                <td>{$patient['email']}</td>
                                <td>{$patient['telephone']}</td>
                                <td>{$doctor['name']} {$doctor['surname']}</td>
                                <td>{$status}</td>
                                </tr>
                                <tr>
                                <td colspan='5' style='text-overflow: ellipsis'>{$row['content']}</td>";
                        }
                        ?>
                        </tbody>
                    </table>
                    <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
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