<!DOCTYPE html>
<html lang="mx">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="/css/estilo_login.css" />
    <title>Crear nueva contraseña</title>
  </head>
  <body>
    <div class="newPwd-page">
    <div class="form">
        <?php
        $selector = $_GET["selector"];
        $validator = $_GET["validator"];

        if(empty($selector) || empty($validator)){
            echo "No se pudo validar su petición";
        } else {
            // comprobar que el selector sea hexadecimal
            if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false ) {
               ?>

               <form action="includes/reset-password.php/" method="post">
                <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                <input type="hidden" name="validator" value="<?php echo $validator; ?>">
                <input type="password" name="pwd" placeholder="Escribe tu nueva contraseña">
                <input type="password" name="pwd-repeat" placeholder="Confirma tu nueva contraseña">
                <button type="submit" name="reset-password-submit">Resetear Contraseña</button>
               </form>

               <?php
            }
        }
        
        ?> 
        </div>    
    </div>
    <script src="/vendor/components/jquery/jquery.min.js"></script>
    <script src="/vendor/components/jquery-cookie/jquery.cookie.js"></script>
    <script
      src="/vendor/fortawesome/font-awesome/js/all.js"
      data-auto-replace-svg="nest"
    ></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="/modulos/login/main.js"></script>
  </body>
</html>
