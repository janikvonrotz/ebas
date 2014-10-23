<?php
include 'get-data.php';

?>
<!DOCTYPE html>
<html lang="en">

<!-- ###header -->

<head>

  <!-- metadata -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="ebas">
  <meta name="author" content="Janik von Rotz (https://janikvonrotz.ch), Sandro Klarer, Luca Kuendig">

  <!-- title and icon -->
  <link rel="icon" href="favicon.ico">
  <title>ebas Prototype</title>

  <link href="./assets/ebas.min.css" rel="stylesheet">

</head>

<!-- ebas id required by list.js -->
<body id="ebas">

  <!-- ###navigation -->

  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">ebas</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Daten<span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
        <li><a href="#">Kurse</a></li>
        <li><a href="#">Anmeldungen</a></li>
        <li><a href="#">Interessenten</a></li>
        <li><a href="#">Benutzer</a></li>
        </ul>
      </li>

      <li><a href="#">Aufgaben</a></li>

      </ul>

      <ul class="nav navbar-nav navbar-right">
        <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="search form-control" placeholder="Search">
        </div>
        </form>
      <li><a href="#">Help</a></li>
      <li><a href="#">Abmelden</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>


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

          <h1 class="page-header">Kurse <button type="button" class="btn btn-default add-row">
          <i class="fa fa-plus"></i></button></h1>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Bezeichnung</th>
                  <th>Sprache</th>
                  <th>Maxmimale Teilnehmer</th>
          <th>Edit</th>
                </tr>
              </thead>
              <tbody class="list">
                <?php

                $arr_len = count($data);
                $i = 0;
                while($i<$arr_len){
                echo '<tr data-id="'.$data[$i]["kurs_id"].'">';
                echo '<td class="ID" contenteditable="false">'.$data[$i]["kurs_id"].'</td>';
                echo '<td class="Beschreibung" contenteditable="true">'.$data[$i]["bezeichnung_de"].'</td>';
                echo '<td class="Ort" contenteditable="true">'.$data[$i]["sprache"].'</td>';
                echo '<td class="Datum" contenteditable="true">'.$data[$i]["max_teilnehmer"].'</td>';
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

  <!-- ###footer -->
  <script src="./assets/ebas.min.js"></script>

</body>
</html>
