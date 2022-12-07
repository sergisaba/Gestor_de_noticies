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
    <title>Afegir Notícia</title>
</head>

<body>
    <div class="container">
        <h1>Afegir notícia</h1>
        <a href="admin.php" name="" value="" class="btn btn-success" role="button"> Tornar ←</a>
        <br><br>
        <br>
        <!-- FORMULARI AFEGIR NOTICIA -->
        <form class="" action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">Titol</label>
                <input type="text" class="form-control" name="titol" placeholder="Titol">
            </div>
            <div class="form-group">
                <label for="">Cos notícia</label>
                <textarea class="form-control" rows="4" name="cos" placeholder="Cos notícia"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Autor</label>
                <input type="text" class="form-control" name="autor" placeholder="Autor">
            </div>
            <div class="form-group">
                <!-- Seccio desplegable -->
                <label for="">Secció</label>
                <select name="select_seccio" class="form-control">
                    <option value="" disabled selected>Selecciona una secció.</option>
                    <?php
                    include("bd/connexio.php");
                    $sql = "SELECT * FROM `seccio`";
                    $execute = mysqli_query($connexio, $sql);

                    while ($lineas = mysqli_fetch_array($execute)) {
                    ?>
                        <option value="<?php echo $lineas['codiSeccio']; ?>"><?php echo $lineas['seccio']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Imatge</label>
                <input type="file" name="fotoNoticia">
                <p class="help-block">Penja la teva imatge.</p>
            </div>

            <input type="submit" name="bform" value="Envia">
        </form>
        <br>
    </div>

    <?php
    if (isset($_POST['bform'])) {
        if (!empty($_POST['titol']) && !empty($_POST['cos']) && !empty($_POST['autor']) && !empty($_POST['select_seccio'])) {

            $titol = $_POST['titol'];
            $cos = $_POST['cos'];
            $autor = $_POST['autor'];
            $seccio = $_POST['select_seccio'];
            $data = date('Y-m-d');

            $temporal = $_FILES['fotoNoticia']['tmp_name'];
            $tipus = $_FILES['fotoNoticia']['type'];

            $dadesimatge = file_get_contents($temporal);
            $dadesimatge = mysqli_real_escape_string($connexio, $dadesimatge);

            $sql = "INSERT INTO `noticia`(`titol`, `cos`, `autor`, `codiSeccio`, `data`, `imatge`, `tipus`) 
            VALUES ('$titol','$cos','$autor','$seccio','$data','$dadesimatge','$tipus')";

            mysqli_query($connexio, $sql);

    ?>
            <div class="container">
                <p style="color: green;">Dades Enviades!</p>
            </div>
        <?php
        } else {
        ?>
            <div class="container">
                <p style="color: red;">Dades no enviades, algun camp buit.</p>
            </div>
    <?php
        }
    }
    ?>
</body>
</html>