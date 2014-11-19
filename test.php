<?php
include 'function.php';
$Config = getConfig();
$conn = DBconnect();

$sql1 = "SELECT anmeldung_id, name, vorname, email, adresse, plz, ort, k.max_teilnehmer
          FROM tbl_anmeldungen_2014_2 as a
          JOIN tbl_kurse_2014_2 as k on k.kurs_id = a.kurs
          WHERE k.kurs_id = 10";

$sql11 = 'SELECT anmeldung_id, name, vorname, email, adresse, plz, ort FROM tbl_anmeldungen_2014_2';

        echo $sql1;

$result1 = mysqli_query($conn, $sql1);
print_r($result1);

?>
