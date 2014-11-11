<?php
include 'function.php';
checkLogin();

// contains id for delete and update methods
if(array_key_exists('id', $_POST)){
  $id = $_POST['id'];
}
// either insert, delete or update
if(array_key_exists('action', $_POST)){
  $action = $_POST['action'];
}
// contains table name
if(array_key_exists('table', $_POST)){
  $table = $_POST['table'];
}

$Config = getConfig();
$conn = DBConnect();

// get sqlname of table
foreach ($Config["tables"] as $itable){
  if($itable["name"]==$table){
      $table = $itable;
      $fields = $itable["fields"];
    }
}

// delete item
if($action == "delete"){

  $sql ="DELETE FROM ".$table["sqlname"]." WHERE ".$fields[0]["sqlname"]." = ".$id;

  mysqli_query($conn, $sql);
  mysqli_close($conn);

// Update item
}elseif($action == "update"){

  $Data = $_POST['data'];

  $sql = 'UPDATE '.$table["sqlname"].' SET ';
  foreach($fields as $field){
    if($fields[0]["name"] != $field["name"]){

      // get the submitted value
      $Value = utf8_decode($Data[$field["name"]]);

      // get options of this field
      if(array_key_exists('options', $field)){
        $options = $field["options"];
      }else{
        $options = "";
      }

      // check if function exists for this field, if yes add the function
      if(array_key_exists('function', $field)){


        // get existing value for this field from DB
        $sqlfieldvalue = "SELECT ".$field["sqlname"]." FROM ".$table["sqlname"]." WHERE ".$fields[0]["sqlname"]."=".$Data["ID"];
        $result = mysqli_query($conn, $sqlfieldvalue);
        $row = mysqli_fetch_array($result, MYSQL_ASSOC);
        $dbvalue = $row[$field["sqlname"]];

        // only runfunction if value is not equal value in DB
        if($dbvalue!=$Value){

          // check wether to run the function once or always
          if((substr_count($options, 'runfunctiononce') > 0) && ($Value == null)){
            $Value = str_replace("%VALUE%", "'".$Value."'", $field['function']);
          }elseif(substr_count($options, 'runfunctiononce') == 0){
            $Value = str_replace("%VALUE%", "'".$Value."'", $field['function']);
          }
        }

      // otherwhise simply insert the given value
      }else{
        $Value = "'".$Value."'";
      }

      $sql = $sql.$field["sqlname"]." = ".$Value;

      if($fields[count($fields) - 1]["name"] != $field["name"]){
        $sql = $sql.", ";
      }
    }
  }
  $sql = $sql.' WHERE '.$fields[0]["sqlname"].'='.$Data["ID"];

  mysqli_query($conn, $sql);
  mysqli_close($conn);

// insert new item
}elseif($action == "insert"){

  $Data = $_POST['data'];

  $sql = 'INSERT INTO '.$table["sqlname"].'(';
  foreach($fields as $field){
    if($fields[0]["name"] != $field["name"]){
      $sql = $sql.$field["sqlname"];
      if($fields[count($fields) - 1]["name"] != $field["name"]){
        $sql = $sql.", ";
      }
    }
  }
  $sql = $sql.") VALUES(";
  foreach($fields as $field){
    if($fields[0]["name"] != $field["name"]){

      // get the submitted value
      $Value = utf8_decode($Data[$field["name"]]);
      // get options of this field
      if(array_key_exists('options', $field)){
        $options = $field["options"];
      }else{
        $options = "";
      }

      // check if function exists for this field
      if(array_key_exists('function', $field)){

        // check wether to run the function once or always
        if((substr_count($options, 'runfunctiononce') > 0) && ($Value == null)){
          $Value = str_replace("%VALUE%", "'".$Value."'", $field['function']);
        }elseif(substr_count($options, 'runfunctiononce') == 0){
          $Value = str_replace("%VALUE%", "'".$Value."'", $field['function']);
        }
      }else{
        $Value = "'".$Value."'";
      }

      $sql = $sql.$Value;
      if($fields[count($fields) - 1]["name"] != $field["name"]){
        $sql = $sql.", ";
      }
    }

  }
  $sql = $sql.")";

  mysqli_query($conn, $sql);
  // response with id
  $response["ID"]=mysqli_insert_id($conn);
  echo json_encode($response);
  mysqli_close($conn);
}

?>
