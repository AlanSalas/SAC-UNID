<?php
error_reporting(E_ALL & ~E_NOTICE);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

$emailto = $_POST['mail'];

try{
$arreglo =  array();
$mail->SMTPDebug = 2;
$mail->setFrom('noreply@smoothoperators.com.mx');
$mail->addAddress('k.manzur13@gmail.com'); // Add a recipient // Name is optiona
$mail->isHTML(true);
$mail->CharSet = 'UTF-8'; // Set email format to HTML
$mail->Subject = 'RESTABLECIMIENTO DE CONTRASEÑA';
$mail->Body = '
    <h1><strong>RESTABLECIMIENTO DE CONTRASEÑA</strong></h1>
    <div id="cuerpo">
    <br>
    <h2 style="text-align: center"><strong>Estimado(a)</strong></h2>
    <p style="font-size: 18px;text-align: center;">Se ha solicitado un cambio de contraseña de su cuenta,<br>de click al siguente link para continuar con el proceso:</p>
    <table style="margin-left:130px">
    <tr>
        <td><span style="font-size:1em;color:#000">Link : <a href="http://www.piesano.com.mx/password_recover.php?='.$emailto.'">http://www.piesano.com.mx/password_recover?='.$emailto.'</a></span></td>
    </tr>
    </table>
    <br>
    <p style="font-size: 18px;text-align: center;">Si usted no reconoce esta acción ignore este mensaje.</p>
    </div><br><br>
    <div style="background-color: #5bc0de;color: white;padding: 15px;margin-top: 10px;text-align: center;">
    <p><strong>Atentamente, <br> El equipo de Pie Sano </strong></p>
    </div>
    </div>';
$mail->send();
echo "se mando el correo";
$mensaje = "OK";
array_push($arreglo,$mensaje,$emailto);
json_encode($arreglo);
}
catch(Exception $e){
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    $mensaje = "ERRORSENT";
    array_push($arreglo,$mensaje,$emailto);
    json_encode($arreglo);
}
// echo $respose;
echo json_encode($arreglo);
?>
