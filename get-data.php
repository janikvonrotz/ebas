<?php


function getview ($view){
  $servername = "localhost";
  $username = "ebas";
  $password = "ebastest";
  $db = "ebas";

// Create connection
  $conn = mysqli_connect($servername, $username, $password, $db);

  if (mysqli_connect_errno()) {
    echo "Failed to connect to Server: " . mysqli_connect_error();
  }

  switch($view){
    case "Kurs":
      $sql = "SELECT
                kurs_id, bezeichnung_de, sprache, max_teilnehmer
              FROM
                tbl_kurse_2014_2";
    break;

    case "Anmeldungen":
      $sql = "SELECT
                anmeldung_id, name, vorname, adresse, plz, ort, email, a.sprache, k.bezeichnung_de, gutschein, zeit
              FROM
                tbl_anmeldungen_2014_2 a
              INNER JOIN
                tbl_kurse_2014_2 k ON (a.kurs = k.kurs_id)";
    break;

    case "Interessenten":
      $sql = "SELECT
                interessent_id, name, vorname, adresse, plz, ort, email, kursort, i.sprache, zeit
              FROM
                tbl_interessenten_2014_2 i";
    break;
  }


  $result = mysqli_query($conn, $sql);
  if(! $result ){
    die('Could not get data: ' . mysql_error());
  }

  $i = 0;
  $c = 0;

  if ($view == "Kurs"){
    while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
      $c = 0;
      $data[$i]["0"] = $row["kurs_id"];
      $data[$i]["1"] = utf8_encode($row["bezeichnung_de"]);
      $data[$i]["2"] = $row["sprache"];
      $data[$i]["3"] = $row["max_teilnehmer"];
      ++$i;

    }
  }
  elseif($view == "Anmeldungen"){
    while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {

      $data[$i]["0"] = $row["anmeldung_id"];
      $data[$i]["1"] = utf8_encode($row["name"]);
      $data[$i]["2"] = utf8_encode($row["vorname"]);
      $data[$i]["3"] = utf8_encode($row["adresse"]);
      $data[$i]["4"] = $row["plz"];
      $data[$i]["5"] = utf8_encode($row["ort"]);
      $data[$i]["6"] = utf8_encode($row["email"]);
      $data[$i]["7"] = utf8_encode($row["sprache"]);
      $data[$i]["8"] = utf8_encode($row["bezeichnung_de"]);
      $data[$i]["9"] = $row["gutschein"];
      $data[$i]["10"] = $row["zeit"];
      ++$i;

    }

  }
  elseif($view == "Interessenten"){
    while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {

      $data[$i]["0"] = $row["interessent_id"];
      $data[$i]["1"] = utf8_encode($row["name"]);
      $data[$i]["2"] = utf8_encode($row["vorname"]);
      $data[$i]["3"] = utf8_encode($row["adresse"]);
      $data[$i]["4"] = $row["plz"];
      $data[$i]["5"] = utf8_encode($row["ort"]);
      $data[$i]["6"] = utf8_encode($row["email"]);
      $data[$i]["7"] = utf8_encode($row["kursort"]);
      $data[$i]["8"] = $row["sprache"];
      $data[$i]["9"] = $row["zeit"];
      ++$i;

    }
  }
  else {
    echo "Now view selected";
  }
  return $data;
  mysqli_close($conn);
}

?>
