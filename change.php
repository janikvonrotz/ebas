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

  // cycle through registered events
  foreach($Config["events"] as $Event){
    // check for event trigger
    if($Event["trigger"]=="RowDelete"){
      // check for certain condition
      if(array_key_exists('tableis', $Event["condition"])){
        // run the condition
        if($table["name"]==$Event["condition"]["tableis"]){
          // check for certain task
          if($Event["task"]["name"]=="copyfields"){
            // run the task specific code
            $sqlselect = "SELECT ";
            foreach($Event["task"]["fieldmap"] as $fmap){
              // generate the select code to get all data from the databse
              $field = getFieldByName($fields,$fmap["source"])["sqlname"];
              $sqlselect = $sqlselect.$field." AS "."`".$fmap["destination"]."`";
              $Lastitem = $Event["task"]["fieldmap"][count($Event["task"]["fieldmap"])-1]["source"];
              if($fmap["source"] != $Lastitem){
                $sqlselect = $sqlselect.", ";
              }
            }
            $srctable = getTableByName($Config["tables"],$Event["condition"]["tableis"])["sqlname"];
            $sqlselect = $sqlselect." FROM ".$srctable." WHERE ".$fields[0]["sqlname"]." = ".$id;
            $result = mysqli_query($conn, $sqlselect);
            $row = mysqli_fetch_array($result, MYSQL_ASSOC);

            // run the insert code
            $desttable = getTableByName($Config["tables"],$Event["task"]["totable"])["sqlname"];
            $sqlinsert="INSERT into ".$desttable."(";
            $sqlinsert2=") VALUES(";
            // get all sqlfieldnames and values from last select
            foreach($Event["task"]["fieldmap"] as $fmap){
              $field = getFieldByName($fields,$fmap["destination"])["sqlname"];
              $sqlinsert = $sqlinsert."`".$field."`";
              $sqlinsert2 = $sqlinsert2."'".$row[$fmap["destination"]]."'";
              $Lastitem = $Event["task"]["fieldmap"][count($Event["task"]["fieldmap"])-1]["destination"];
              if($fmap["destination"] != $Lastitem){
                $sqlinsert = $sqlinsert.", ";
                $sqlinsert2 = $sqlinsert2.", ";
              }
            }

            $sqlinsert=$sqlinsert.$sqlinsert2.")";
            $result = mysqli_query($conn, $sqlinsert);
            echo $sqlinsert." ".$sqlselect;
          }
        }
      }
    }
  }

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
      $Value = getConfigProcessedValue($Data,$table,$fields,$field,$Value);

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
      $Value = getConfigProcessedValue($Data,$table,$fields,$field,$Value);

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
