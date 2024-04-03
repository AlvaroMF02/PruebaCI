<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url() ?>styles/estilo.css">
    <title>Login</title>
</head>

<body>
    <div id="cont-login">
        <h1>Login</h1>
        <form action="" method="post" id="login">
            <div>
                <label for="usuario">Usuario</label><br>
                <input type="text" name="usuario" id="usuario">
            </div>
            <div>
                <label for="clave">Contraseña</label><br>
                <input type="password" name="clave" id="clave">
            </div>

            <button type="submit">Entrar</button>
            <?php
                    if(isset($_SESSION["error"])){
                        echo "<span class='error'>" . $_SESSION["error"]."</span>";
                    }
                ?>
        </form>
    </div>

</body>

</html>