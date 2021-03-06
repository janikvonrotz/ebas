<?php
include 'function.php';
$Config = getConfig();
checkLogin();

if (array_key_exists('view', $_GET)){

  // get name of table to show
  $view = $_GET['view'];

  foreach ($Config["tables"] as $table){
    if($table["name"] == $view){
      $data = getTable($table["name"]);
      $fields = $table["fields"];
      $page = $table["name"];
    }
  }

  getHeader($view);
  getNavigation();
?>

  <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

          <div class="btn-group pull-right " role="group" aria-label="...">
            <button type="button" class="btn btn-default refresh-page">
            <i class="fa fa-refresh"></i> Refresh
            </button>
            <button type="button" class="btn btn-default export-csv">
            <i class="fa fa-download"></i> Export
            </button>
          </div>

          <h1 class="page-header"><?php echo $view; ?> <button type="button" class="btn btn-default add-row">
          <i class="fa fa-plus"></i></button></h1>

          <div class="dropdowns hide">

            <?php
            foreach ($fields as $field){
              echo getDropdownHtmlByField($field);
            }
            ?>
          </div>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <?php

                    foreach ($fields as $field){

                      // check if column is editable and store the information
                      if(array_key_exists('options', $field)){
                        if(substr_count($field["options"], 'contenteditable')){
                          $contenteditable="true";
                        }else{
                          $contenteditable="false";
                        }
                      }else{
                        $contenteditable="false";
                      }

                      echo '<th iscontenteditable="'.$contenteditable.'">'.$field["name"].'</th>';
                    };

                  ?>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody class="list">
                <?php

                $arr_len = count($data);
                $arr_wide = max(array_map("count", $data));
                $r = 0;

                while($r<$arr_len-1){
                  $c = 1;
                  // write id [1][0]
                  echo '<tr data-id="'.$data[($r+1)][0].'">';

                  // write header in classname 0-0 and id 1-0
                  echo '<td class="'.$data[0][0].'" contenteditable="false">'.$data[($r+1)][0].'</td>';

                  while ($c<$arr_wide){

                    // write content 1-n and class header 0-0
                    // check wether field is editable or not
                    foreach($fields as $field){
                      if($field["name"]==$data[0][$c]){
                        if(array_key_exists('options', $field)){
                          if(substr_count($field["options"], 'contenteditable')){
                            $contenteditable="true";
                          }else{
                            $contenteditable="false";
                          }
                        }else{
                          $contenteditable="false";
                        }
                      }
                    }

                    // Write content
                    echo '<td class="'.$data[0][$c].'"><div style="height: "100%"; width: "100%";" contenteditable="'.$contenteditable.'">'.$data[($r+1)][$c].'</div></td>';
                    $c++;
                  }

                  echo '<td>';
                  echo '<button type="button" class="btn btn-default btn-sm save-row"><i class="fa fa-save"></i></button> ';
                  echo '<button type="button" class="btn btn-danger btn-sm delete-row"><i class="fa fa-trash-o"></i></button>';
                  echo '</td>';
                  echo '</tr>';
                  $r++;
                }
                ?>

              </tbody>
            </table>

            </script>
          </div>
        </div>
      </div>
    </div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h3 class="modal-title" id="myModalLabel">Bitte bestätigen</h3>
            </div>
            <div class="modal-body">
                 <h4>Sind Sie sicher, dass sie diesen Datensatz löschen wollen?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnDelteYes" href="#">Ja</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Nein</button>
            </div>
        </div>
    </div>
</div>


<?php }else{

  $view = "Übersicht";
  getHeader($view);
  getNavigation();
  $conn = DBconnect();
  $Config = getConfig();

  $sql = "SELECT bezeichnung_de, max_teilnehmer, kurs_id
          FROM tbl_kurse_2014_2 WHERE kurs_datum >= DATE(NOW()) ORDER BY kurs_datum";

  $result = mysqli_query($conn, $sql);

  if(! $result ){
    die('Could not get data: ' . mysql_error());
  }

  $c = 0;
    while($row = mysqli_fetch_assoc($result)){
        $Data[$c][0] = utf8_encode($row['bezeichnung_de']);
        $Data[$c][1] = utf8_encode($row['max_teilnehmer']);
        $Data[$c][2] = $row['kurs_id'];
        $c++;
    }
 ?>

<div class="container-fluid">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">

        <button type="button" class="btn btn-default refresh-page pull-right">
        <i class="fa fa-refresh"></i> Refresh
        </button>

        <h1 class="page-header">Übersicht</h1>

<div class="panel-group" id="accordion">

<?php

$z = 0;
while($z<sizeof($Data)){
  $sql1 = "SELECT anmeldung_id, name, vorname, email, adresse, plz, ort, k.max_teilnehmer
            FROM tbl_anmeldungen_2014_2 as a
            JOIN tbl_kurse_2014_2 as k on k.kurs_id = a.kurs
            WHERE k.kurs_id = ".$Data[$z][2] ;

  $result1 = mysqli_query($conn, $sql1);
  if(! $result1 ){
    die('Could not get data: ' . mysql_error());
  }

$sql2 = "SELECT COUNT(*)
        FROM tbl_anmeldungen_2014_2 as a
        JOIN tbl_kurse_2014_2 as k on k.kurs_id = a.kurs
        WHERE k.kurs_id =".$Data[$z][2];
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a data-toggle="collapse" data-parent="#accordion" href="<?php echo '#collapse'.$z ?>" aria-expanded="false">
       <?php echo $Data[$z][0]; ?> <span class="badge pull-right"> <?php echo $row2["COUNT(*)"]."/".$Data[$z][1]; ?></span>
      </a>
    </h4>
  </div>
  <div id="<?php echo 'collapse'.$z ?>" class="panel-collapse collapse">
    <div class="panel-body">

<div class="table-responsive">
<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Nachname</th>
      <th>E-Mail</th>
      <th>Adresse</th>
    </tr>
  </thead>
  <tbody class="list">

  <?php
    $k = 0;
    while($row1 = mysqli_fetch_array($result1, MYSQL_ASSOC)){
      $Data2[0] = $row1["anmeldung_id"];
      $Data2[1] = utf8_encode($row1["name"]);
      $Data2[2] = utf8_encode($row1["vorname"]);
      $Data2[3] = utf8_encode($row1["email"]);
      $Data2[4] = utf8_encode($row1["adresse"]);
      $Data2[5] = $row1["plz"];
      $Data2[6] = utf8_encode($row1["ort"]);
  ?>

    <tr data-id="1">
      <td class="ID" contenteditable="false"><?php echo $Data2[0]; ?></td>
      <td class="Name" contenteditable="false"><?php echo $Data2[1]; ?></td>
      <td class="Nachname" contenteditable="false"><?php echo $Data2[2]; ?></td>
      <td class="E-Mail" contenteditable="false"><?php echo $Data2[3]; ?></td>
      <td class="Adresse" contenteditable="false"><?php echo $Data2[4].', '.$Data2[5].' '.$Data2[6]; ?></td>
    </tr>
  <?php
    $k++;
  }
  ?>
</tbody>
</table>
</div>

    </div>
  </div>
</div>
<?php
  $z++;
}
?>

</div>

      </div>
      <div class="col-md-2"></div>
    </div>
  </div>

<?php } getFooter(); ?>
