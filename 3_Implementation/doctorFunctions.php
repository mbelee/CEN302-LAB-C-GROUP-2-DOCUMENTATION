<?php
// session_start();

function display_specs()
{
    foreach (Doctor::getSpecialties() as $spec) {
        echo '<option value = "' .$spec. '">'.$spec.'</option>';
    }
}

function display_docs()
{
    $result = Doctor::getDoctors();
    foreach ($result as $row) {
        echo '<option value="' .$row['id']. '" data-value="'.$row['specialty'].'">'.$row['name']." ".$row['surname'].'</option>';
    }
}

?>