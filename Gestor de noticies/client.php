<?php
session_start();

if ($_SESSION["usr"] == "" or $_SESSION["usr"] != "client") {
    header("Location: index.php");
}

if (isset($_POST['torna'])) {
    session_destroy();
    header("Location: index.php");
    
}

//PAGINACIÓ
if (isset($_REQUEST['paginacio'])) {
    $inici = $_REQUEST['paginacio'];
}else{
    $inici = 0;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <!-- Fots awesome -->
    <script src="https://kit.fontawesome.com/9210da3ccb.js" crossorigin="anonymous"></script>
    <title>Notícies</title>
</head>

<body>
    <div class="container">
        <h1>Notícies</h1>
        <form class="form" action="" method="post" enctype="multipart/form-data"> 
            <input type="submit" class="btn btn-success" value="Log-out ←" name="torna"></input>
        </form>
        <br>
        <br>
        <div class="row">
            <form class="" action="" method="post" enctype="multipart/form-data">
                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="">Buscador:</label>
                        <input type="search" class="form-control" name="buscar" placeholder="Busca...">
                    </div>
                        <input type="submit" name="Bbuscar" value="Buscar" class="btn btn-default">
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <!-- Seccio desplegable -->
                        <label for="">Secció:</label>
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
                        <br>
                        <input type="submit" name="Bseccio" value="Buscar" class="btn btn-default">
                    </div>
                </div>
            </form>
        </div>
        <br><br>
        <?php
            $linies = 10;
            $sql = "select n.autor, n.data, n.cos, n.titol, n.tipus, n.imatge ,s.seccio from noticia n join seccio s where n.codiSeccio = s.codiSeccio order by n.data desc limit $inici,$linies";
            if (isset($_POST['Bbuscar'])) {
                $busc = $_POST['buscar'];
                $sql = "select n.autor, n.data, n.cos, n.titol, n.tipus, n.imatge ,s.seccio from noticia n join seccio s ON n.codiSeccio = s.codiSeccio where n.titol LIKE '%$busc%' order by n.data desc limit $inici,$linies";
            }
            if (isset($_POST['Bseccio'])) {
                $secc = $_POST['select_seccio'];
                $sql = "select n.autor, n.data, n.cos, n.titol, n.tipus, n.imatge ,s.seccio, s.codiSeccio from noticia n join seccio s ON n.codiSeccio = s.codiSeccio where s.codiSeccio = $secc order by n.data desc limit $inici,$linies";
            }
            $impresos  = 0;
            $resultat = mysqli_query($connexio,$sql);

            while($fila = mysqli_fetch_array($resultat)){
            $impresos++;
        ?>

        <div class="contenedor_opinion">
        <div class="contenedor_img">
            <!-- Foto -->
            <?php 
            echo '<img src="data:'.$fila['tipus'].';base64,'.base64_encode($fila['imatge']).'">';
            ?>

        </div>
        <div class="contenedor_texto">        
            <h2><?php echo $fila['titol']?></h2>

            <?php
            
            ?>
            <p><?php echo $fila['cos']?></p>
            <br><br>
            <?php

            ?>
            <p class="dreta"><?php echo $fila['autor']?></p>
            <br>
            <?php

            ?>
            <p class="dreta"><?php echo $fila['data']?></p>
            <?php

            ?>
            <p><a>Secció: </a><?php echo $fila['seccio']?></p>
            <br>
        </div>
        </div>
        <?php 
            }
            mysqli_close($connexio);

            if ($inici == 0) {
                ?>
                <div class="container text-center">
                <a style="text-decoration:none; color:black;" class="text-center">Anteriors</a>
                </div>
                <?php
            }else{
                $anterior = $inici-$linies;
        
                ?>
                <div class="container text-center btn">
                <?php
                echo "<a class='btn btn-success' href=\"client.php?paginacio=$anterior\">Anteriors</a>";
                ?>
                </div>
                
                <?php
                
            }

            if ($impresos == $linies) {
                $proper = $inici+$linies;
         
                ?>
                <div class="container text-center">
                <?php
                echo "<a class='btn btn-success' href=\"client.php?paginacio=$proper\" >Següents</a>";
                ?>
                </div>
                <br><br>
                <?php
                
           
            }
            else{
                ?>
                 <div class="container text-center">
                <a style="text-decoration:none; color:black;" class="text-center">Següents</a>
                </div>
                <br><br>
                <?php
            }
        ?>
    </div>
</body>
</html>
