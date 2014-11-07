<?php
include 'function.php';
$Config = getConfig();
checkLogin();

if (array_key_exists('view', $_GET)){

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

  <!-- ###content -->

  <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
    <!-- <button type="button" class="btn btn-default export-csv">
      <span class="glyphicon glyphicon-floppy-save"></span> CSV
    </button> -->
          <button type="button" class="btn btn-default refresh-page pull-right">
          <i class="fa fa-refresh"></i> Refresh
          </button>

          <h1 class="page-header"><?php echo $view; ?> <button type="button" class="btn btn-default add-row">
          <i class="fa fa-plus"></i></button></h1>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <?php

                    foreach ($fields as $field) {
                      echo '<th>'.$field["name"].'</th>';
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
                    echo '<td class="'.$data[0][$c].'" contenteditable="true">'.$data[($r+1)][$c].'</td>';
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
            <!--/modal-body-collapse -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnDelteYes" href="#">Ja</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Nein</button>
            </div>
            <!--/modal-footer-collapse -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php }else{

  $view = "Übersicht";
  getHeader($view);
  getNavigation();

 ?>

<div class="container-fluid">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">

  <!-- <button type="button" class="btn btn-default export-csv">
    <span class="glyphicon glyphicon-floppy-save"></span> CSV
  </button> -->
        <button type="button" class="btn btn-default refresh-page pull-right">
        <i class="fa fa-refresh"></i> Refresh
        </button>

        <h1 class="page-header">Übersicht</h1>

<div class="panel-group" id="accordion">
<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
        01.01.2014 - Kurs Zürich <span class="badge pull-right">16</span>
      </a>
    </h4>
  </div>
  <div id="collapseOne" class="panel-collapse collapse in">
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
    <tr data-id="1">
      <td class="ID" contenteditable="false">1</td>
      <td class="Name" contenteditable="true">Lorem</td>
      <td class="Nachname" contenteditable="true">ipsum</td>
      <td class="E-Mail" contenteditable="true">dolor</td>
      <td class="Adresse" contenteditable="true">sit</td>
    </tr>
    <tr data-id="2">
      <td class="ID" contenteditable="false">2</td>
      <td class="Name" contenteditable="true">amet</td>
      <td class="Nachname" contenteditable="true">consectetur</td>
      <td class="E-Mail" contenteditable="true">adipiscing</td>
      <td class="Adresse" contenteditable="true">elit</td>
    </tr>
  </tbody>
</table>
</div>

    </div>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
        09.01.2014 - Kurs Luzern <span class="badge pull-right">10</span>
      </a>
    </h4>
  </div>
  <div id="collapseTwo" class="panel-collapse collapse">
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
    <tr data-id="1">
      <td class="ID" contenteditable="false">1</td>
      <td class="Name" contenteditable="true">Lorem</td>
      <td class="Nachname" contenteditable="true">ipsum</td>
      <td class="E-Mail" contenteditable="true">dolor</td>
      <td class="Adresse" contenteditable="true">sit</td>
    </tr>
    <tr data-id="2">
      <td class="ID" contenteditable="false">2</td>
      <td class="Name" contenteditable="true">amet</td>
      <td class="Nachname" contenteditable="true">consectetur</td>
      <td class="E-Mail" contenteditable="true">adipiscing</td>
      <td class="Adresse" contenteditable="true">elit</td>
    </tr>
  </tbody>
</table>
</div>

    </div>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
        20.02.2014 - Kurs Bern <span class="badge pull-right">20</span>
      </a>
    </h4>
  </div>
  <div id="collapseThree" class="panel-collapse collapse">
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
    <tr data-id="1">
      <td class="ID" contenteditable="false">1</td>
      <td class="Name" contenteditable="true">Lorem</td>
      <td class="Nachname" contenteditable="true">ipsum</td>
      <td class="E-Mail" contenteditable="true">dolor</td>
      <td class="Adresse" contenteditable="true">sit</td>
    </tr>
    <tr data-id="2">
      <td class="ID" contenteditable="false">2</td>
      <td class="Name" contenteditable="true">amet</td>
      <td class="Nachname" contenteditable="true">consectetur</td>
      <td class="E-Mail" contenteditable="true">adipiscing</td>
      <td class="Adresse" contenteditable="true">elit</td>
    </tr>
  </tbody>
</table>
</div>

    </div>
  </div>
</div>
</div>

      </div>
      <div class="col-md-2"></div>
    </div>
  </div>

<?php } getFooter(); ?>
