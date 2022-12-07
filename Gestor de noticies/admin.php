<?php
session_start();

if ($_SESSION["usr"] == "" or $_SESSION["usr"] != "admn") {
    header("Location: index.php");
}

if (isset($_POST['torna'])) {
    session_destroy();
    header("Location: index.php");
    
  }
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
        <div class="text-center">
            <h1>Notícies</h1>
            <br>
            <form class="form" action="" method="post" enctype="multipart/form-data"> 
                <input type="submit" class="btn btn-success" value="Log-out ←" name="torna"></input>
            </form>
            <br>
            <a href="Afegir.php" name="" value="" class="btn btn-success" role="button"> Afegir notícia</a>

            <a href="Eliminar.php" name="" value="" class="btn btn-success" role="button"> Eliminar notícia</a>
            
            <a href="Modificar.php" name="" value="" class="btn btn-success" role="button"> Modificar notícia</a>
        </div>
    </div>
</body>
</html>