<!DOCTYPE html>
<?php
require_once 'models/Doctor.php';
require_once 'models/Patient.php';
require_once 'models/MedicalRecords.php';
require_once 'models/Checkup.php';
require_once 'models/Receptionist.php';
require_once 'models/Feedback.php';
require_once 'models/Message.php';
include('doctorFunctions.php');

if (isset($_POST['docsub'])) {
    if (Doctor::getDoctorByEmail($_POST['email'])) {
        echo "<script>alert('Doctor already exists!');</script>";
    } else {
        if ($_POST['password']==$_POST['cpassword']){
            $doctor = new Doctor($_POST['name'], $_POST['surname'], $_POST['father_name'], $_POST['birth_year'], $_POST['gender'], $_POST['password'],$_POST['telephone'],$_POST['specialty'],$_POST['email']);
            $doctor->saveDoctor($doctor);
            echo "<script>alert('Doctor added successfully!');</script>";
        }
        else{
            echo "<script>alert('Passwords do not match!');</script>";
        }
    }
}


if (isset($_POST['docsub1'])) {
    if (Doctor::deleteDoctor(Doctor::getDoctorByEmail($_POST['email'])['id'])) {
        echo "<script>alert('Doctor deleted successfully!');</script>";
    } else {
        echo "<script>alert('Doctor does not exist!');</script>";
    }
}


?>
<html lang="en">
<head>
        <meta charset="utf-8">
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
              integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <a class="navbar-brand" href="#"><i class="fa fa-hospital-o" aria-hidden="true"></i> Hospital Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <script>
            var check = function () {
                if (document.getElementById('password').value ==
                    document.getElementById('cpassword').value) {
                    document.getElementById('message').style.color = '#5dd05d';
                    document.getElementById('message').innerHTML = 'Matched';
                } else {
                    document.getElementById('message').style.color = '#f55252';
                    document.getElementById('message').innerHTML = 'Password fields doesnot match';
                }
            }
        </script>
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
<style>
    button:hover {
        cursor: pointer;
    }

    #inputbtn:hover {
        cursor: pointer;
    }
</style>
<body style="padding-top:50px;">
<div class="container-fluid" style="margin-top:50px;">
    <h3 style="margin-left: 40%; padding-bottom: 20px;font-family: 'IBM Plex Sans', sans-serif;"> WELCOME RECEPTIONIST</h3>
    <div class="row">
        <div class="col-md-4" style="max-width:25%;margin-top: 3%;">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" href="#list-dash" id="list-dash-list" role="tab"
                   aria-controls="home" data-toggle="list">Dashboard</a>
                <a class="list-group-item list-group-item-action" href="#list-doc" id="list-doc-list" role="tab"
                   aria-controls="home" data-toggle="list">View Doctors</a>
                <a class="list-group-item list-group-item-action" href="#list-pat" id="list-pat-list" role="tab"
                   data-toggle="list" aria-controls="home">View Patients</a>
                <a class="list-group-item list-group-item-action" href="#list-app" id="list-app-list" role="tab"
                   data-toggle="list" aria-controls="home">Checkup Details</a>
                <a class="list-group-item list-group-item-action" href="#list-pres" id="list-pres-list" role="tab"
                   data-toggle="list" aria-controls="home">Medical History List</a>
                <a class="list-group-item list-group-item-action" href="#list-settings" id="list-adoc-list" role="tab"
                   data-toggle="list" aria-controls="home">Add Doctor</a>
                <a class="list-group-item list-group-item-action" href="#list-settings1" id="list-ddoc-list" role="tab"
                   data-toggle="list" aria-controls="home">Delete Doctor</a>
                <a class="list-group-item list-group-item-action" href="#list-mes" id="list-mes-list" role="tab"
                   data-toggle="list" aria-controls="home">Feedbacks</a>
            </div>
            <br>
        </div>
        <div class="col-md-8" style="margin-top: 3%;">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-user-md fa-stack-1x fa-inverse"></i> </span>
                                        <h4 class="StepTitle" style="margin-top: 5%;">Doctor List</h4>
                                        <script>
                                            function clickDiv(id) {
                                                document.querySelector(id).click();
                                            }
                                        </script>
                                        <p class="links cl-effect-1">
                                            <a href="#list-doc" onclick="clickDiv('#list-doc-list')">
                                                View Doctors
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4" style="left: -3%">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-users fa-stack-1x fa-inverse"></i> </span>
                                        <h4 class="StepTitle" style="margin-top: 5%;">Patient List</h4>

                                        <p class="cl-effect-1">
                                            <a href="#app-hist" onclick="clickDiv('#list-pat-list')">
                                                View Patients
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-4">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
                                        <h4 class="StepTitle" style="margin-top: 5%;">Checkup Details</h4>

                                        <p class="cl-effect-1">
                                            <a href="#app-hist" onclick="clickDiv('#list-app-list')">
                                                View Checkups
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4" style="left: 13%;margin-top: 5%;">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-file-powerpoint-o fa-stack-1x fa-inverse"></i> </span>
                                        <h4 class="StepTitle" style="margin-top: 5%;">Medical History List</h4>

                                        <p class="cl-effect-1">
                                            <a href="#list-pres" onclick="clickDiv('#list-pres-list')">
                                                View Medical Histories
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-4" style="left: 18%;margin-top: 5%">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-plus-circle fa-stack-1x fa-inverse"></i> </span>
                                        <h4 class="StepTitle" style="margin-top: 5%;">Manage Doctors</h4>

                                        <p class="cl-effect-1">
                                            <a href="#app-hist" onclick="clickDiv('#list-adoc-list')">Add Doctors</a>
                                            &nbsp|
                                            <a href="#app-hist" onclick="clickDiv('#list-ddoc-list')">
                                                Delete Doctors
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="list-doc" role="tabpanel" aria-labelledby="list-doc-list">
                    <div class="container-fluid container-fullw bg-white">
                    <div class="col-md-8">
                        <form class="form-group" action="doctorsearch.php" method="post">
                            <div class="row">
                                <div class="col-md-10"><input type="text" name="search"
                                                              placeholder="Search Doctor" class="form-control"></div>
                                <div class="col-md-2"><input type="submit" name="doctor_search_submit"
                                                             class="btn btn-primary" value="Search"></div>
                            </div>
                        </form>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Doctor Name</th>
                            <th scope="col">Specialization</th>
                            <th scope="col">Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $cnt = 1;
                        foreach (Doctor::getDoctors() as $doctor) {
                            echo "<tr>
                                  <td>$cnt</td>
                                  <td>{$doctor['name']} {$doctor['surname']}</td>
                                  <td>{$doctor['specialty']}</td>
                                  <td>{$doctor['email']}</td>
                                  </tr>";
                            $cnt++;
                        }

                        ?>
                        </tbody>
                    </table>
                    <br>
                    </div>
                </div>
                <div class="tab-pane fade" id="list-pat" role="tabpanel" aria-labelledby="list-pat-list">
                    <div class="container-fluid container-fullw bg-white">
                    <div class="col-md-8">
                        <form class="form-group" action="patientsearch.php" method="post">
                            <div class="row">
                                <div class="col-md-10"><input type="text" name="search"
                                                              placeholder="Search Patient" class="form-control"></div>
                                <div class="col-md-2"><input type="submit" name="patient_search_submit"
                                                             class="btn btn-primary" value="Search"></div>
                            </div>
                        </form>
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fullname</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telephone</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $cnt = 1;
                        foreach (Patient::getPatients() as $patient) {
                            echo "<tr>
                                  <td>$cnt</td>
                                  <td>{$patient['name']} {$patient['surname']}</td>
                                  <td>{$patient['gender']}</td>
                                  <td>{$patient['email']}</td>
                                  <td>{$patient['telephone']}</td>
                                  </tr>";
                            $cnt++;
                        }

                        ?>
                        </tbody>
                    </table>
                    <br>
                    </div>
                </div>
                <div class="tab-pane fade" id="list-app" role="tabpanel" aria-labelledby="list-app-list">
                    <div class="container-fluid container-fullw bg-white">
                    <div class="col-md-12">

                        <div class="row">


                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Patient</th>
                                    <th scope="col">Doctor</th>
                                    <th scope="col">BloodType</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Allergies</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                require_once 'db-conn.php';
                                global $con;
                                $cnt = 1;
                                foreach (MedicalRecords::getAllMedicalRecords() as $record) {
                                    $patient = Patient::getPatient($record['patients_id']);
                                    $doctor = Doctor::getDoctor($record['doctors_id']);
                                    echo "<tr>
                                  <td>$cnt</td>
                                  <td>{$record['date_created']}</td>
                                  <td>{$patient['name']} {$patient['surname']}</td>
                                  <td>{$doctor['name']} {$doctor['surname']}</td>
                                  <td>{$record['bloodtype']}</td>
                                  <td>{$record['details']}</td>
                                  <td>{$record['allergies']}</td>
                                  </tr>";
                                    $cnt++;
                                }

                                ?>
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="list-pres" role="tabpanel" aria-labelledby="list-pres-list">
                    <div class="container-fluid container-fullw bg-white">
                    <div class="col-md-8">
                        <form class="form-group" action="checkupsearch.php" method="post">
                            <div class="row">
                                <div class="col-md-10"><input type="text" name="app_contact" placeholder="Search"
                                                              class="form-control"></div>
                                <div class="col-md-2"><input type="submit" name="app_search_submit"
                                                             class="btn btn-primary" value="Search"></div>
                            </div>
                        </form>
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fullname</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Doctor</th>
                            <th scope="col">Date</th>
                            <th scope="col">Details</th>
                            <th scope="col">Diagnosis</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        require_once 'db-conn.php';
                        global $con;
                        $cnt = 1;
                        foreach (Checkup::getCheckups() as $checkup) {
                            $patient = Patient::getPatient($checkup['patients_id']);
                            $doctor = Doctor::getDoctor($checkup['doctors_id']);
                            echo "<tr>
                                  <td>$cnt</td>
                                  <td>{$patient['name']} {$patient['surname']}</td>
                                  <td>{$patient['gender']}</td>
                                    <td>{$patient['email']}</td>
                                    <td>{$patient['telephone']}</td>
                                    <td>{$doctor['name']} {$doctor['surname']}</td>
                                    <td>{$checkup['date_created']}</td>
                                    <td>{$checkup['details']}</td>
                                    <td>{$checkup['diagnosis']}</td>
                                    </tr>";
                            $cnt++;
                        }
                        ?>
                        </tbody>
                    </table>
                    <br>
                    </div>
                </div>
                <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-adoc-list">
                    <div class="container-fluid container-fullw bg-white">
                    <form class="form-group" method="post" action="receptionist-panel.php">
                        <div class="row">
                            <div class="col-md-4"><label>Name:</label></div>
                            <div class="col-md-8"><input type="text" class="form-control" name="name" required></div>
                            <br><br>
                            <div class="col-md-4"><label>Father Name:</label></div>
                            <div class="col-md-8"><input type="text" class="form-control" name="father_name" required>
                            </div>
                            <div class="col-md-4"><label>Surname:</label></div>
                            <div class="col-md-8"><input type="text" class="form-control" name="surname" required></div>
                            <br><br>
                            <div class="col-md-4"><label>Birth Year:</label></div>
                            <div class="col-md-8"><input type="date" class="form-control" name="birth_year" required>
                            </div>
                            <div class="col-md-4"><label>Gender:</label></div>
                            <div class="col-md-8">
                                <label class="radio inline">
                                    <input type="radio" name="gender" value="Male" checked>
                                    <span> Male </span>
                                </label>
                                <label class="radio inline">
                                    <input type="radio" name="gender" value="Female">
                                    <span>Female </span>
                                </label>
                            </div>
                            <br><br>
                            <div class="col-md-4"><label>Password:</label></div>
                            <div class="col-md-8"><input type="password" class="form-control" onkeyup='check();'
                                                         name="password" id="dpassword" required></div>
                            <br><br>
                            <div class="col-md-4"><label>Confirm Password:</label></div>
                            <div class="col-md-8" id='cpass'><input type="password" class="form-control"
                                                                    onkeyup='check();' name="cpassword" id="cdpassword"
                                                                    required>&nbsp &nbsp<span id='message'></span></div>
                            <br><br>
                            <div class="col-md-4"><label>Telephone:</label></div>
                            <div class="col-md-8"><input type="text" class="form-control" name="telephone" required></div>
                            <br><br>
                            <div class="col-md-4"><label>Specialization:</label></div>
                            <div class="col-md-8">
                                <select name="specialization" class="form-control" id="special" required="required">
                                    <option value="head" name="spec" disabled selected>Select Specialization</option>
                                    <option value="General" name="spec">General</option>
                                    <option value="Gynecologist" name="spec">Gynecologist</option>
                                    <option value="Oncologist">Oncologist</option>
                                    <option value="Cardiologist" name="spec">Cardiologist</option>
                                    <option value="Gastroenterologist">Gastroenterologist</option>
                                    <option value="Neurologist" name="spec">Neurologist</option>
                                    <option value="Pediatrician" name="spec">Pediatrician</option>
                                </select>
                            </div>
                            <br><br>
                            <div class="col-md-4"><label>Email:</label></div>
                            <div class="col-md-8"><input type="email" class="form-control" name="email" required></div>
                            <br><br>
                        </div>
                        <input type="submit" name="docsub" value="Add Doctor" class="btn btn-primary">
                    </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="list-settings1" role="tabpanel" aria-labelledby="list-ddoc-list">
                    <div class="container-fluid container-fullw bg-white">
                    <form class="form-group" method="post" action="receptionist-panel.php">
                        <div class="row">

                            <div class="col-md-4"><label>Email:</label></div>
                            <div class="col-md-8"><input type="email" class="form-control" name="email" required></div>
                            <br><br>

                        </div>
                        <input type="submit" name="docsub1" value="Delete Doctor" class="btn btn-primary"
                               onclick="confirm('do you really want to delete?')">
                    </form>
                </div>
                <div class="tab-pane fade" id="list-mes" role="tabpanel" aria-labelledby="list-mes-list">
                    <div class="col-md-8">
                        <form class="form-group" action="feedbackSearch.php" method="post">
                            <div class="row">
                                <div class="col-md-10"><input type="text" name="mes_contact" placeholder="Search Feedbacks"
                                                              class="form-control"></div>
                                <div class="col-md-2"><input type="submit" name="mes_search_submit"
                                                             class="btn btn-primary" value="Search"></div>
                            </div>
                        </form>
                    </div>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Patient</th>
                            <th scope="col">Date</th>
                            <th scope="col">Comment</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $cnt = 1;
                        foreach (Message::getMessages() as $message) {
                            $patient = Patient::getPatient($message['patients_id']);
                            echo "<tr>
                                  <td>$cnt</td>
                                  <td>{$patient['name']} {$patient['surname']}</td>
                                  <td>{$message['date_created']}</td>
                                  <td>{$message['content']}</td>
                                  </tr>";
                            $cnt++;
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
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>