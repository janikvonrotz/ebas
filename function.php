<?php

// returns array with json data
function getConfig(){

  $JsonData = file_get_contents("config.json");
  $Config = json_decode($JsonData,true);

  return $Config;

}

// returns db connect object
function DBConnect(){

  $Config = getConfig();

  // Create connection
  $conn = mysqli_connect($Config["server"], $Config["user"], $Config["password"], $Config["database"]);

  if (mysqli_connect_errno()) {
    echo "Failed to connect to Server: " . mysqli_connect_error();
  }

  return $conn;
}
?>

<?php function getHeader($title){ ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="ebas">
      <meta name="author" content="Janik von Rotz (https://janikvonrotz.ch), Sandro Klarer, Luca Kuendig">

      <link rel="icon" href="favicon.ico">
      <title><?php echo ($title); ?></title>

      <link href="./assets/ebas.min.css" rel="stylesheet">

    </head>

    <body id="ebas">

<?php } ?>

<?php function getNavigation(){
$Config = getConfig(); ?>

  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">ebas</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Daten<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">

        <?php
          foreach ($Config["tables"] as $table) {
            echo '<li><a href="index.php?view=';
            echo $table["name"];
            echo '">';
            echo $table["name"];
            echo '</a></li>';
          };
        ?>

        </ul>
      </li>

      <li><a href="task.php">Aufgaben</a></li>

      </ul>

      <ul class="nav navbar-nav navbar-right">
        <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="search form-control" placeholder="Search">
        </div>
        </form>
      <li><a href="help.php">Help</a></li>
      <li><a href="login.php?mode=logoff">Abmelden</a></li>
      </ul>
    </div>
    </div>
  </nav>

<?php } ?>

<?php function getFooter(){ ?>

  <script src="./assets/ebas.min.js"></script>

</body>
</html>

<?php } ?>

<?php

// returns html table
function getTable($view){

  $conn = DBConnect();

  switch($view){
    case "Kurse":
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
