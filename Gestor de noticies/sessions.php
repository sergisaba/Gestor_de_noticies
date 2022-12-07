<?php
session_start();

$_SESSION["usr"] = $_POST["usuari"];
$_SESSION["pass"] = $_POST["contrasenya"];

// echo  md5($_POST["contrasenya"]);
if($_SESSION["usr"] == "client" && $_SESSION["pass"] == '1234'){
    header("Location: client.php");
}
elseif($_SESSION["usr"] == "admn" && $_SESSION["pass"] == '1234'){
    header("Location: admin.php");
}
else{
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
        <!-- Fots awesome -->
        <script src="https://kit.fontawesome.com/9210da3ccb.js" crossorigin="anonymous"></script>
        <title>Gestor de notícies</title>
    </head>
    <body>
    <div class="container">
            <div class="">
            <h1 class="text-center">Gestor de noticíes</h1>
            <h2 class="text-center">Log-in</h2>
            <br>
            <form class="form" action="sessions.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="exampleInputEmail1">Usuari: </label>
                  <input type="text" class="form-control" name="usuari" placeholder="Usuari">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Contrasenya: </label>
                  <input type="password" class="form-control" name="contrasenya" placeholder="Contrasenya">
                </div>
                <input type="submit" class="btn btn-success" value="Entra" name="Bform"></input>
                <p style="color:red;">Dades incorrectes!</p>
              </form>
            </div>
        </div>
    </div>
</body>
    <?php
}


?>