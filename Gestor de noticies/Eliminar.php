<?php
session_start();

if ($_SESSION["usr"] == "" or $_SESSION["usr"] != "admn") {
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
    <title>Eliminar notícia</title>
</head>
<body>

<div class="container">
    <h1>Eliminar notícia</h1>
    <a href="admin.php" name="" value="" class="btn btn-success" role="button"> Tornar ←</a>
    <br><br>

    <?php
        include("bd/connexio.php");

        if (isset($_POST['bform'])) {
        $noticia = $_POST['select_noticia'];
        $sql = "DELETE FROM `noticia` WHERE `codiNoticia` = '$noticia'";
        $execute = mysqli_query($connexio,$sql);
        ?>
            <div class="container">
                <p style ="color: green;">Notícia eliminada!</p>
            </div>
        <?php
        }

        $sql="SELECT * FROM `noticia`";
        $execute = mysqli_query($connexio, $sql);
    ?>


    <form action="" class="" action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <!-- Seccio desplegable -->
        <label for="">Selecciona la notícia a eliminar:</label>
        <select name="select_noticia" class="form-control">
            <option value="" disabled selected>Selecciona una notícia.</option>
            <?php 
            $sql="SELECT * FROM `noticia`";
            $execute = mysqli_query($connexio, $sql);

            while($lineas = mysqli_fetch_array($execute)){
            ?>
            <option value="<?php echo $lineas['codiNoticia'];?>"><?php echo $lineas['titol'];?></option>
            <?php 
            }
            ?>
        </select>
    </div>
    <input type="submit" name="bform" value="Elimina">
    </form>
    <br>
</div>


</body>
</html>
