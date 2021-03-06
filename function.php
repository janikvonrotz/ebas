<?php
include 'events.php';

// helper functions
function getTableByName($name){
  $Config = getConfig();
  foreach($Config["tables"] as $table){
    if($table["name"]==$name){
      return $table;
    }
  }
}
function getFieldByName($fields,$name){
  foreach($fields as $field){
    if($field["name"]==$name){
      return $field;
    }
  }
}

// create the dropdown html data for a field
function getDropdownHtmlByField($field){

  // Template: <select name="Kurs"><option value="kurs_id">bezeichnung_de</option><option...</option></select>
  if(array_key_exists('dropdownsql', $field)){
    $DB = DBConnect();
    if ($result = mysqli_query($DB, $field["dropdownsql"])){
      $fieldcount = mysqli_field_count($DB);

      // create select html
      $selecthtml = '<select name="'.$field["name"].'">';

      // create options
      $c = 0;
      while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $k = 0;
        while($k<sizeof($row)){
          $Options[$c][$k] = utf8_encode($row[$k]);
          $k++;
        }
        $selecthtml = $selecthtml.'<option value="'.$Options[$c][0].'">';
        for($i=1; $i<$fieldcount; $i++){
          $selecthtml = $selecthtml.$Options[$c][$i];
        }
        $c++;
      }
    }
    $selecthtml = $selecthtml."</select>";

    // close db and return html
    DBClose($DB);
    return $selecthtml;
  }
}

// checks function for this field in the config and prcesses it
/*
  $Data:  Data containing all row values
  $table: Config definiton of the current table
  $fields: Config field definitions of the current table
  $Value: Current field value to process
*/
function getConfigProcessedValue($Data, $table, $fields, $field, $Value){

  // get options of this field
  if(array_key_exists('options', $field)){
    $options = $field["options"];
  }else{
    $options = "";
  }

  // check if function exists for this field, if yes add the function
  if(array_key_exists('function', $field)){

    // get existing value for this field from DB
    $dbvalue = "";
    if($Data["ID"]){

      $conn = DBConnect();
      $sqldbvalue = "SELECT ".$field["sqlname"]." FROM ".$table["sqlname"]." WHERE ".$fields[0]["sqlname"]."=".$Data["ID"];
      $result = mysqli_query($conn, $sqldbvalue);
      $row = mysqli_fetch_array($result, MYSQL_ASSOC);
      $dbvalue = $row[$field["sqlname"]];

      DBClose($conn);
    }

    // only runfunction if value is not equal value in DB
    if($Value != $dbvalue || $Value==null){

      // check wether to run the function once or always
      if((substr_count($options, 'runfunctiononce') > 0) && ($Value == null)){
        $Value = str_replace("%VALUE%", "'".$Value."'", $field['function']);
      }elseif(substr_count($options, 'runfunctiononce') == 0){
        $Value = str_replace("%VALUE%", "'".$Value."'", $field['function']);
      }else{
        $Value = "'".$Value."'";
      }
    }else{
      $Value = "'".$Value."'";
    }

  // otherwhise simply insert the given value
  }else{
    $Value = "'".$Value."'";
  }

  return $Value;
}

// every php is only accessable with a valid session
function checkLogin(){
  session_start();
  if (!$_SESSION["user"]){

    // User not logged in, redirect to login page
    Header("Location: login.php");
  }
}

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

// Close connection
function DBClose($conn){
  mysqli_close($conn);
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
    <div class="container">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">ebas</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Daten<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="index.php">Übersicht</a></li>
        <?php
          foreach ($Config["tables"] as $table) {

            if(array_key_exists('options', $table)){
              $options=$table["options"];
            }else{
              $options="";
            }

            if(!(substr_count($options, 'hide') > 0)){
              if(!(substr_count($options, 'adminonly') > 0) || ($_SESSION["isadmin"]==1)){
                echo '<li><a href="index.php?view=';
                echo $table["name"];
                echo '">';
                echo $table["name"];
                echo '</a></li>';
              }
            }
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
      <li><a href="help.php">Hilfe</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Benutzer<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
          <li><a><?=$_SESSION["user"]?></a></li>
          <li class="divider"></li>
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
  $Config = getConfig();

  $sql = "";
  $tables = $Config["tables"];

  foreach ($tables as $table) {

    // create sql query for selected table
    if($table["name"] == $view){

      if(array_key_exists('options', $table)){
        $options=$table["options"];
      }else{
        $options="";
      }

      if(!(substr_count($options, 'hide') > 0)){
      if(!(substr_count($options, 'adminonly') > 0) || ($_SESSION["isadmin"]==1)){

        // sql query start
        $sql = $table["sqlstart"];
        $fields = $table["fields"];

        // cycle through fields of the table
        foreach ($fields as $field){

          // change the header of the field
          $sql = $sql.$field["sqlname"]." AS '".$field["name"]."'";

          // seperate the definitons with commas
          if($fields[count($fields) - 1]["name"] != $field["name"]){
            $sql = $sql.", ";
          }
        };

        // finish the sql statement
        $sql = $sql.$table["sqlend"];
      }}
    }
  }
  $result = mysqli_query($conn, $sql);
  if(!$result ){;
    die('Could not get data: ' . mysql_error());
  }

  // counters for two-dimensional data array
  $i = 0;
  $i2 = 0;

  // set headers for datatable
  foreach ($fields as $field){
    $data[$i][$i2] = utf8_encode($field["name"]);
    ++$i2;
  }
  ++$i;

  // set content for datatable
  while($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
    $i3 = 0;

    // get the mysql data foreach row and header
    foreach ($fields as $field){
      $fieldname = $field["sqlname"];

      // if the field is part of the dropdown query output the content as <select><option>
      $data[$i][$i3] = utf8_encode($row[$field["name"]]);
      ++$i3;
    }
    ++$i;
  }

  return $data;
  mysqli_close($conn);
}
?>
