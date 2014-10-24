<?php
include 'function.php';

if (array_key_exists('view', $_GET)){

}
else {
  $_GET['view'] = "Kurs";
}

if ($_GET['view']=='Kurs'){
  $data = getTable ("Kurs");
  $page = 'Kurs';
}
elseif ($_GET['view']=='Anmeldungen'){
  $data = getTable ("Anmeldungen");
  $page = 'Anmeldungen';
}
elseif ($_GET['view']=='Interessenten'){
  $data = getTable ("Interessenten");
  $page = 'Interessenten';
}

$view = $_GET['view'];
getHeader("Kurs");
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
                    if ($_GET['view']=='Kurs'){
                      echo '<th>ID</th>';
                      echo '<th>Bezeichnung</th>';
                      echo '<th>Sprache</th>';
                      echo '<th>Maxmimale Teilnehmer</th>';
                    }
                    elseif ($_GET['view']=='Anmeldungen'){
                      echo '<th>ID</th>';
                      echo '<th>Name</th>';
                      echo '<th>Vorname</th>';
                      echo '<th>Adresse</th>';
                      echo '<th>Postleihzahl</th>';
                      echo '<th>Ort</th>';
                      echo '<th>Email</th>';
                      echo '<th>Sprache</th>';
                      echo '<th>Kurs</th>';
                      echo '<th>Gutscheincode</th>';
                      echo '<th>Anmeldedatum</th>';
                    }
                    elseif ($_GET['view']=='Interessenten'){
                      echo '<th>ID</th>';
                      echo '<th>Name</th>';
                      echo '<th>Vorname</th>';
                      echo '<th>Adresse</th>';
                      echo '<th>Postleihzahl</th>';
                      echo '<th>Ort</th>';
                      echo '<th>Email</th>';
                      echo '<th>Kursort</th>';
                      echo '<th>Sprache</th>';
                      echo '<th>Interessiert seit</th>';
                    }
                  ?>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody class="list">
                <?php

                $arr_len = count($data);
                $arr_wide = max(array_map("count", $data));
                $i = 0;
                while($i<$arr_len){
                  $c = 1;
                  echo '<tr data-id="'.$data[$i]["0"].'">';
                  echo '<td class="ID" contenteditable="false">'.$data[$i]["0"].'</td>';
                  while ($c<$arr_wide){
                      echo '<td contenteditable="true">'.$data[$i][$c].'</td>';
                      $c++;
                    }

                  echo '<td>';
                  echo '<button type="button" class="btn btn-default btn-sm save-row"><i class="fa fa-save"></i></button>';
                  echo '<button type="button" class="btn btn-default btn-sm delete-row"><i class="fa fa-trash-o"></i></button>';
                  echo '</td>';
                  echo '</tr>';
                  $i++;
                }
                ?>
              <!-- <script type="text/javascript">

                var myrows = new Array();
                  var z = 0
                  for (var i = 0; i < 8; i++){

                    myrows[i] = new Array();
                    myrows[i]["ID"] = i;
                    myrows[i]["Beschreibung"] = z;
                    myrows[i]["Ort"] = ++z;
                    myrows[i]["Datum"] = ++z;
                    myrows[i]["Typ"] = ++z;

                    ++z;
                  }

                  for (var j = 0; j < myrows.length; j++){

                  document.write('<tr data-id='+myrows[j]["ID"]+'>');
                  document.write('<td class="ID" contenteditable="false">'+myrows[j]["ID"]+'</td>');
                  document.write('<td class="Beschreibung" contenteditable="true">'+''+'</td>');
                  document.write('<td class="Ort" contenteditable="true">'+myrows[j]["Sprache"]+'</td>');
                  document.write('<td class="Datum" contenteditable="true">'+myrows[j]["Datum"]+'</td>');
                  document.write('<td>')
                      document.write('<button type="button" class="btn btn-default btn-sm save-row"><i class="fa fa-save"></i></button>');
                      document.write('<button type="button" class="btn btn-default btn-sm delete-row"><i class="fa fa-trash-o"></i></button>');
                  document.write('</td>');
                document.write('</tr>');
              }
            </script> -->
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

<?php getFooter(); ?>
