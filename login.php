<?php
include 'function.php';
getHeader("ebas Login");
$Config = getConfig();
session_start();

// check mode
if (array_key_exists('mode', $_GET)){

  $mode = $_GET['mode'];
  if($mode=="logoff"){

    // destroy active session
    session_unset();
    session_destroy();
  }

  if($mode=="login"){

    // connect DB
    $conn = DBConnect();

    // get login table config
    foreach ($Config["tables"] as $table){
      if($table["name"]=="LoginTable"){

        $logintable = $table;

        foreach($table["fields"] as $field){
          if($field["name"]=="Benutzer"){
            $userfield = $field;
          }
          if($field["name"]=="Passwort"){
            $passwordfield=$field;
          }
        }
      }
    }

    // compare username and password with DB table
    $sql = $logintable["sqlstart"]."*".$logintable["sqlend"]
          ." WHERE `".$userfield["sqlname"]."`='".mysqli_real_escape_string($conn, $_POST["email"])."'"
          ." AND `".$passwordfield["sqlname"]."`='".sha1($_POST["password"])."'"
          ." LIMIT 1";

    // Run query
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQL_ASSOC);

    if($row){

      $_SESSION["user"] = $_POST["email"];
      $_SESSION["isadmin"] = $row["isAdmin"];
      $_SESSION["time"] = time();

      // Redirect to index page
      Header("Location: index.php");

    }else{

        // Login not successful
        $mode="loginfailed";
    }

    mysqli_close($conn);
  }
}
?>

<div class="container">
  <form class="form-signin" action="?mode=login" method="POST" role="form">

    <div class="alert alert-success <?php if($mode!="logoff"){echo "hide";} ?>" role="alert">Sie haben sich erfolgreich abgemeldet.</div>
    <div class="alert alert-danger <?php if($mode!="loginfailed"){echo "hide";} ?>" role="alert">Ihr Benutzername oder Passwort ist falsch.</div>

    <h2 class="form-signin-heading">Please sign in</h2>

    <input type="email" name="email" class="form-control" placeholder="Email address" required="" autofocus="" autocomplete="off" style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=); background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">
    <input type="password" name="password" class="form-control" placeholder="Password" required="" autocomplete="off" style="background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=); background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;">

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  </form>
</div>

<?php getFooter(); ?>
