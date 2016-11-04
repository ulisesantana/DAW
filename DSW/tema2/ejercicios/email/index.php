<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Envío de Emails</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

      <style media="screen">
          @import url('https://fonts.googleapis.com/css?family=Montserrat');
          body {
              background-color: #eee;
              font-family: "Montserrat", sans-serif;
          }

          #profile {
              background-color: #333;
              color: #fff;
              height: 100vh;
              width: 25vw;
              position: fixed;
          }

          #profile img {
              max-width: 150px;
              margin: 20px auto;
          }

          #profile h3 {
              text-align: center;
              padding: 15px;
          }

          #profile li.active{
            background-color: #eee;
          }

          #main {
              width: 73vw;
              padding: 2% 3%;
              margin-left: 24vw;
          }

          .space{padding-top:5%;}
      </style>
</head>

<body>

    <div id="profile">
        <img src="https://avatars3.githubusercontent.com/u/17091490?v=3&s=466" alt="" class="img-responsive img-circle">
        <h3 class="text-center">Ulises Santana Suárez <br><small>2º DAW</small></h3>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav">
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
        </div>
    </div> <!-- /profile -->

    <div id="main">
      <?php

        require_once('phpmailer/class.phpmailer.php');

        $destinatario = "alumnoprobando35@gmail.com";
        $asunto = "Probando mails desde php";
        $texto = "Hola, he sido escrito desde PHP.";

        enviarEmail($destinatario, $asunto, $texto);

        function enviarEmail($direccion, $asunto, $texto){
          $mail = new phpmailer();
          $mail->IsSMTP();
          $mail->Mailer = "smtp";

          // Rellenar los datos con una cuenta de GMail:
          $mail->Host = "smtp.googlemail.com";
          $mail->SMTPAuth = true;
          $mail->SMTPSecure = "ssl";
          $mail->Port = 465;
          $mail->Username = "alumnoprobando35@gmail.com"; // Cuenta del emisor
          $mail->Password = "alumnodsw"; // Contraseña del emisor
          $mail->From = "alumnoprobando35@gmail.com"; // Dirección del emisor

          // Rellenar los datos del email
          $mail->FromName = "FULANITO DE TAL"; // Remitente que le aparece al receptor
          $mail->Timeout=30;
          $mail->AddAddress($direccion); // Dirección del destinatario
          $mail->Subject = $asunto; // Asunto del email
          $mail->Body = $texto; // Contenido del email
          $mail->AltBody = $texto; // Contenido del email alternativo


          $exito = $mail->Send();
          $intentos=1;

          while ((!$exito) && ($intentos < 5)) {
            sleep(5);
            $exito = $mail->Send();
            $intentos++;
          }

          if (!$exito) {
            echo '<p class="text-danger"> No se ha podido enviar el correo
            electronico: ' . $mail->ErrorInfo . '</p>';
          } else {
            echo '<p class="text-success"> Mensaje enviado a ' . $direccion . '
            correctamente.</p>';
          }
        }

        ?>
    </div> <!-- /main -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
