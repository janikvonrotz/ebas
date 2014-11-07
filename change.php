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

if($action == "delete"){

  $sql ="DELETE FROM ".$table["sqlname"]." WHERE ".$fields[0]["sqlname"]." = ".$id;

  mysqli_query($conn, $sql);
  mysqli_close($conn);

}elseif($action == "update"){


  $Data = $_POST['data'];


  $sql = 'UPDATE '.$table["sqlname"].' SET ';


  foreach($fields as $field){

    if($fields[0]["name"] != $field["name"]){
      $sql = $sql.$field["sqlname"]." = '".utf8_decode($Data[$field["name"]])."'";

      if($fields[count($fields) - 1]["name"] != $field["name"]){
        $sql = $sql.", ";
      }
    }
  };

  $sql = $sql.' WHERE '. $fields[0]["sqlname"].'='.$Data["ID"];

  mysqli_query($conn, $sql);
  mysqli_close($conn);


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
      $sql = $sql."'".utf8_decode($Data[$field["name"]])."'";
      if($fields[count($fields) - 1]["name"] != $field["name"]){
        $sql = $sql.", ";
      }
    }

  }
  $sql = $sql.")";

  mysqli_query($conn, $sql);

  // response with id
  $response["ID"]=4;
  // echo (mysqli_query($conn,"SELECT LAST_INSERT_ID()"));
  echo json_encode($response);

  mysqli_close($conn);
}

?>
