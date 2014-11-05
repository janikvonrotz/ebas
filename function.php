<?php

// every php is only accessable with a valid session
function checkLogin(){
  session_start();

  if (!$_SESSION["valid_user"]){
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
      <a class="navbar-brand" href="index.php">ebas</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Daten<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">

        <?php
          foreach ($Config["tables"] as $table) {
            if(!array_key_exists('options', $table) || (strpos($table["options"],'hide') == true)){
              echo '<li><a href="index.php?view=';
              echo $table["name"];
              echo '">';
              echo $table["name"];
              echo '</a></li>';
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
  $Config = getConfig();

  $sql = "";
  $tables = $Config["tables"];

  foreach ($tables as $table) {

    // create sql query for selected table
    if($table["name"] == $view){

      // sql query start
      $sql = $table["sqlstart"];
      $fields = $table["fields"];

      // cycle through fields of the table
      foreach ($fields as $field){

        // check if theres a special query name of the field
        // if(array_key_exists('sqlqueryname',$field)){
        //   $sqlname=$field["sqlqueryname"];
        // }else{
        //   $sqlname=$field["sqlname"];
        // }

        // check if the field contains a dropdown, execute the statement and save the result for the datatable


        // change the header of the field
        $sql = $sql.$field["sqlname"]." AS '".$field["name"]."'";

        // seperate the definitons with commas
        if($fields[count($fields) - 1]["name"] != $field["name"]){

          $sql = $sql.", ";
        }
      };

      // finish the sql statement
      $sql = $sql.$table["sqlend"];
    }
  }
  $result = mysqli_query($conn, $sql);
  if(! $result ){
    die('Could not get data: ' . mysql_error());
  }

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
