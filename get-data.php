<?php

$servername = "localhost";
$username = "ebas";
$password = "ebastest";
$db = "ebas";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

if (mysqli_connect_errno()) {
  echo "Failed to connect to Server: " . mysqli_connect_error();
}


$sql = "SELECT kurs_id, bezeichnung_de, sprache, max_teilnehmer FROM tbl_kurse_2014_2";


$result = mysqli_query($conn, $sql);
if(! $result )
{
  die('Could not get data: ' . mysql_error());
}
$i = 0;
while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {

  $data[$i]["kurs_id"] = $row["kurs_id"];
  $data[$i]["bezeichnung_de"] = utf8_encode($row["bezeichnung_de"]);
  $data[$i]["sprache"] = $row["sprache"];
  $data[$i]["max_teilnehmer"] = $row["max_teilnehmer"];
  ++$i;

}

$jsonarray = json_encode($data);
mysqli_close($conn);

?>
