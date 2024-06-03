<!DOCTYPE html>
<?php
include('loginPatient.php');
include('doctorFunctions.php');
require_once 'models/Doctor.php';
require_once 'models/Checkup.php';
require_once 'models/MedicalRecords.php';
require_once 'models/Patient.php';

if (isset($_POST['app-submit'])) {
    $doctor = Doctor::getDoctor($_POST['doctor']);
    $checkup = new Checkup($_SESSION['pid'], $_POST['doctor'], $_POST['details'], $_POST['appdate']);
    if (Checkup::saveCheckup($checkup)) {
        echo "<script>alert('Appointment booked successfully');</script>";
    } else {
        echo "<script>alert('Unable to book appointment');</script>";
    }


}

if (isset($_GET['cancel'])) {
    if (Checkup::cancelCheckup($_GET['ID'])) {
        echo "<script>alert('Appointment cancelled successfully');</script>";
    } else {
        echo "<script>alert('Unable to cancel appointment');</script>";
    }
}


function generate_pdf()
{
    $output = '';
    $result = MedicalRecords::getMedicalRecordsByPatient($_SESSION['pid']);
    if ($result) {
        foreach ($result as $row) {
            $doctor = Doctor::getDoctor($row['doctors_id']);
            $patient = Patient::getPatient($row['patients_id']);
            $output .= '
        <h3>Patient Name</h3>
        <h4>' . $patient['name'] . ' ' . $patient['surname'] . '</h4>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Doctor</th>
            <th scope="col">Date</th>
            <th scope="col">BloodType</th>
            <th scope="col">Allergies</th>
            <th scope="col">Details</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>' . $doctor['name'] . ' ' . $doctor['surname'] . '</td>
            <td>' . $row['date_created'] . '</td>
            <td>' . $row['bloodtype'] . '</td>
            <td>' . $row['allergies'] . '</td>
            <td>' . $row['details'] . '</td>
          </tr>
        </tbody>
      </table>
      ';
        }
    } else {
        $output .= "<tr><td colspan='6'>No records found</td></tr>";

    }

    return $output;
}


if (isset($_GET["generate_pdf"])) {
    require_once("TCPDF/tcpdf.php");
    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle("Medical Record");
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $obj_pdf->SetHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->SetFooterFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
    $obj_pdf->SetPrintHeader(false);
    $obj_pdf->SetPrintFooter(false);
    $obj_pdf->SetAutoPageBreak(TRUE, 10);
    $obj_pdf->SetFont('helvetica', '', 12);
    $obj_pdf->AddPage();

    $content = '';

    $content .= '
      <br/>
      <h2>Hospital Management System</h2></br>
      <h3>Patient Medical Record</h3>
      

  ';

    $content .= generate_pdf();
    $obj_pdf->writeHTML($content);
    ob_end_clean();
    $patient = Patient::getPatient($_SESSION['pid']);
    $obj_pdf->Output("MedicalRecord" . $patient['name'] . "_" . $patient['surname'] . date('Y-m-d') . ".pdf", 'I');

}

?>
<html lang="en">
<head>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">

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
            .bg-primary {
                /* background: -webkit-linear-gradient(left, #3931af, #00c6ff); */
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

            .btn-primary {
                background-color: #3c50c1;
                border-color: #3c50c1;
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
    <h3 style="margin-left: 40%;  padding-bottom: 20px; font-family: 'IBM Plex Sans', sans-serif;"> Welcome
        &nbsp<?php echo Patient::name($_SESSION['pid']) ?>
    </h3>
    <div class="row">
        <div class="col-md-4" style="max-width:25%; margin-top: 3%">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-dash-list" data-toggle="list"
                   href="#list-dash" role="tab" aria-controls="home">Dashboard</a>
                <a class="list-group-item list-group-item-action" id="list-home-list" data-toggle="list"
                   href="#list-home" role="tab" aria-controls="home">Book Checkup</a>
                <a class="list-group-item list-group-item-action" href="#app-hist" id="list-pat-list" role="tab"
                   data-toggle="list" aria-controls="home">Checkup History</a>
                <a class="list-group-item list-group-item-action" href="#list-pres" id="list-pres-list" role="tab"
                   data-toggle="list" aria-controls="home">Medical History</a>

            </div>
            <br>
        </div>
        <div class="col-md-8" style="margin-top: 3%;">
            <div class="tab-content" id="nav-tabContent" style="width: 950px;">


                <div class="tab-pane fade  show active" id="list-dash" role="tabpanel" aria-labelledby="list-dash-list">
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-sm-4" style="left: 5%">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-bookmark fa-stack-1x fa-inverse"></i> </span>
                                        <h4 class="StepTitle" style="margin-top: 5%;"> Book My Checkup</h4>
                                        <script>
                                            function clickDiv(id) {
                                                document.querySelector(id).click();
                                            }
                                        </script>
                                        <p class="links cl-effect-1">
                                            <a href="#list-home" onclick="clickDiv('#list-home-list')">
                                                Book Checkup
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4" style="left: 10%">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x"> <i
                                                    class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                    class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
                                        <h2 class="StepTitle" style="margin-top: 5%;">My Checkup</h2>

                                        <p class="cl-effect-1">
                                            <a href="#app-hist" onclick="clickDiv('#list-pat-list')">
                                                View Checkup History
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4" style="left: 20%;margin-top:5%">
                            <div class="panel panel-white no-radius text-center">
                                <div class="panel-body">
                                    <span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i
                                                class="fa fa-file-powerpoint-o fa-stack-1x fa-inverse"></i> </span>
                                    <h2 class="StepTitle" style="margin-top: 5%;">Medical History</h2>

                                    <p class="cl-effect-1">
                                        <a href="#list-pres" onclick="clickDiv('#list-pres-list')">
                                            View Medical History
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>


                <div class="tab-pane fade" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                    <div class="container-fluid container-fullw bg-white">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-body">
                                <h4>Book Checkup</h4>
                                <br>
                                <form class="form-group" method="post" action="patient-panel.php">
                                    <div class="row">


                                        <div class="col-md-4">
                                            <label for="spec">Specialization:</label>
                                        </div>
                                        <div class="col-md-8">
                                            <select name="spec" class="form-control" id="spec">
                                                <option value="" disabled selected>Select Specialization</option>
                                                <?php
                                                display_specs();
                                                ?>
                                            </select>
                                        </div>

                                        <br><br>

                                        <script>
                                            document.getElementById('spec').onchange = function foo() {
                                                let spec = this.value;
                                                console.log(spec)
                                                let docs = [...document.getElementById('doctor').options];

                                                docs.forEach((el, ind, arr) => {
                                                    arr[ind].setAttribute("style", "");
                                                    if (el.getAttribute("data-spec") != spec) {
                                                        arr[ind].setAttribute("style", "display: none");
                                                    }
                                                });
                                            };

                                        </script>

                                        <div class="col-md-4"><label for="doctor">Doctors:</label></div>
                                        <div class="col-md-8">
                                            <select name="doctor" class="form-control" id="doctor" required="required">
                                                <option value="" disabled selected>Select Doctor</option>

                                                <?php display_docs(); ?>
                                            </select>
                                        </div>
                                        <br/><br/>

                                        <div class="col-md-4"><label>Checkup Date</label></div>
                                        <div class="col-md-8"><input type="date" class="form-control datepicker"
                                                                     name="appdate"></div>
                                        <br><br>
                                        <div class="col-md-4"><label>Details</label></div>
                                        <div class="col-md-8"><input type="text" class="form-control" name="details">
                                        </div>
                                        <br><br>

                                        <div class="col-md-4">
                                            <input type="submit" name="app-submit" value="Create new entry"
                                                   class="btn btn-primary" id="inputbtn">
                                        </div>
                                        <div class="col-md-8"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <br>
                    </div>
                </div>

                <div class="tab-pane fade" id="app-hist" role="tabpanel" aria-labelledby="list-pat-list">
                    <div class="container-fluid container-fullw bg-white">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Doctor</th>
                            <th scope="col">Date</th>
                            <th scope="col">Diagnosis</th>
                            <th scope="col">Details</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $result = Checkup::getCheckupsByPatient($_SESSION['pid']);
                        if ($result) {
                            $cnt = 1;
                            foreach ($result as $row) {
                                $doctor = Doctor::getDoctor($row['doctors_id']);
                                $patient = Patient::getPatient($row['patients_id']);
                                $status = $row['date_created'] > date('Y-m-d') ? 'Upcoming' : 'Completed';
                                echo "<tr>
                                <td>" . $cnt . "</td>
                                <td>" . $doctor['name'] . " " . $doctor['surname'] . "</td>
                                <td>" . $row['date_created'] . "</td>
                                <td>" . $row['diagnosis'] . "</td>
                                <td>" . $row['details'] . "</td>
                                <td>" . $status . "</td>
                                <td>
                                    <a href='patient-panel.php?cancel=1&ID=" . $row['id'] . "'>
                                        <button class='btn btn-danger'>Cancel</button>
                                    </a>
                                </td>
                            </tr>";
                                $cnt++;

                            }
                        } else {
                            echo "<tr><td colspan='7'>No records found</td></tr>";
                        }
                        ?>
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
                            <th scope="col">Doctor</th>
                            <th scope="col">Date</th>
                            <th scope="col">BloodType</th>
                            <th scope="col">Allergies</th>
                            <th scope="col">Details</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $result = MedicalRecords::getMedicalRecordsByPatient($_SESSION['pid']);
                        if ($result) {
                            foreach ($result as $row) {
                                $doctor = Doctor::getDoctor($row['doctors_id']);
                                $patient = Patient::getPatient($row['patients_id']);
                                echo "<tr>
                                <td>" . $doctor['name'] . " " . $doctor['surname'] . "</td>
                                <td>" . $row['date_created'] . "</td>
                                <td>" . $row['bloodtype'] . "</td>
                                <td>" . $row['allergies'] . "</td>
                                <td>" . $row['details'] . "</td>
                                <td>
                                    <a href='patient-panel.php?generate_pdf=1&ID=" . $row['id'] . "'>
                                        <button class='btn btn-primary'>Download</button>
                                    </a>
                                </td>
                            </tr>";

                            }
                        } else {
                            echo "<tr><td colspan='6'>No records found</td></tr>";
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.1/sweetalert2.all.min.js">
</script>


</body>
</html>
