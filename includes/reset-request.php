<?php

if(isset($_POST["reset-request-submit"])) {

    // convierte a hexadecimal los bytes
    $selector = bin2hex(random_bytes(8));
    // token para autenticar el usuario correcto
    $token = random_bytes(32);

    // crear link que se le va a enviar al usuario
    $url = "http://www.smoothoperators.com.mx/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    // crear una fecha de expiración para token
    $expires = date("U") +1800;

    // insertar a la tabla en la BD
    require_once $_SERVER["DOCUMENT_ROOT"].'includes/database.php';

    $userEmail = $_POST["email"];

    // borrar datos existentes de tokens por el mismo usuario en la BD
    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // crear mensaje de error
        echo "Hubo un error!";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    // insertar a BD
    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // crear mensaje de error
        echo "Hubo un error!";
        exit();
    } else {
        // Hash a la información
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    // mandar email
    $to = $userEmail;

    $subject = 'Restaurar contraseña';

    $message = '<p>Hemos recibido una petición para un cambio de contraseña. 
    Aquí encontrara el link para hacer el cambio: <br>';
    $message .='<a href="' . $url . '">'. $url .'</a></p>';

    $headers = "De: La Logia Corp <noreply@smoothoperators.com.mx>\r\n";
    $headers .= "Reply-To: replyto@smoothoperators.com.mx\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);

    header("Location: /includes/reset-password.inc.php?=success");



}else{
    header("Location: /index.php/");
}
