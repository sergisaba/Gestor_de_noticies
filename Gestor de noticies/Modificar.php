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
    <title>Modificar notícia</title>
</head>
<body>

    <div class="container">
            <h1>Modificar notícia</h1>
            <a href="admin.php" name="" value="" class="btn btn-success" role="button"> Tornar ←</a>
            <br><br>
            <?php
                include("bd/connexio.php");

                $sql="SELECT * FROM `noticia`";
                $execute = mysqli_query($connexio, $sql);
            ?>

        <!-- PRIMER FORMULARI -->
        <form action="" class="" action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <!-- Seccio desplegable -->
                <label for="">Selecciona la notícia a modificar:</label>
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
            <input type="submit" name="bmodifica" value="Modifica">
        </form>
    </div>

    <?php
    if (isset($_POST['bmodifica'])) {

            $sql = "SELECT * FROM `noticia` WHERE `codiNoticia` = '".$_POST['select_noticia']."'";
            $execute = mysqli_query($connexio, $sql);

            while ($lineas = mysqli_fetch_array($execute)) {
            ?>
            <br><br>
        <div class="container">
        <form action="" class="" action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="id">Titol:</label>
            <input type="text" class="form-control" name="titol" value="<?php echo $lineas['titol'];?>">
        </div>
        <div class="form-group">
            <label for="id">Cos notícia: </label>
            <textarea class="form-control" rows="4" name="cos" placeholder="<?php echo $lineas['cos'];?>"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">Nova imatge</label>
            <input type="file" name="fotoNoticia">
            <p class="help-block">Penja la nova imatge.</p>
        </div>
        <input type="hidden" name="invisible" value="<?php echo $lineas['codiNoticia']; ?>">
        <input type="submit" name="bmodificat" value="Enviar">
        </form>
        </div>
  <?php
  }
}
?>

<?php
if (isset($_POST['bmodificat'])) {
  if (!empty($_POST['titol']) && !empty($_POST['cos'])){

    $titol = $_POST['titol'];
    $cos = $_POST['cos'];
    $hid = $_POST['invisible'];
    
    $temporal = $_FILES['fotoNoticia']['tmp_name'];
    $tipus = $_FILES['fotoNoticia']['type'];

    $dadesimatge = file_get_contents($temporal);
    $dadesimatge = mysqli_real_escape_string($connexio, $dadesimatge);

    $sql="UPDATE `noticia` SET `titol`= '$titol' ,`cos`= '$cos',`imatge`= '$dadesimatge',`tipus`= '$tipus' WHERE `codiNoticia` = '$hid'";

    mysqli_query($connexio, $sql);

    ?>
    <div class="container">
        <p style ="color: green;">Dades actualitzades!</p>
    </div>
<?php
    mysqli_close($connexio);
  }else{
    ?>
    <div class="container">
        <p style ="color: red;">Dades no enviades, algun camp buit.</p>
    </div>
<?php
  }
}
 ?>

</body>
</html>