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

<?php function getNavigation(){ ?>

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
        <li><a href="index.php?view=Kurs">Kurse</a></li>
        <li><a href="index.php?view=Anmeldungen">Anmeldungen</a></li>
        <li><a href="index.php?view=Interessenten">Interessenten</a></li>
        <li><a href="#">Benutzer</a></li>
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

  <script src="/assets/ebas.min.js"></script>

</body>
</html>

<?php } ?>
