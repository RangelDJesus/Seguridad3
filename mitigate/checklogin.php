<?php
session_start();
?>

<?php

$CaptchaToken = $_POST['g-recaptcha-response'];

if($CaptchaToken!=''){
  $secret = "6Lc3M3IjAAAAAExazO0Ym9L7Y0S3OY3d_aI5wcFB";
  $ip = $_SERVER['REMOTE_ADDR'];
  $var = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$CaptchaToken&remoteip=$ip");

  $array = json_decode($var,true);
  if($array['success']){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conexion = new mysqli("localhost","root","","Seguridade3");

    if ($conexion->connect_error) {
      die("La conexion falló: " . $conexion->connect_error);
    }
 
    $sql = "SELECT * FROM users WHERE username = '$username'";

    $result = $conexion->query($sql);
    if ($result->num_rows  <1 ) {
      echo "El usuario no existe.";
      header("HTTP/1.1 404 Not Found");
      echo "<br><a href='index.php'>Volver a Intentarlo</a>";
    }else{
      $row = $result->fetch_array(MYSQLI_ASSOC);
      if ($password==$row['password']) { 
 
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $username;
      $_SESSION['start'] = time();
      $_SESSION['expire'] = $_SESSION['start'] + (2*15);

      echo "Bienvenido! " . $_SESSION['username'];
      echo "<br><br><a href=panel-control.php>Panel de Control</a>"; 
      header('Location: panel-control.php');
      } else { 
        echo "Username o Password estan incorrectos.";
        header("HTTP/1.1 404");
        echo "<br><a href='index.php'>Volver a Intentarlo</a>";
      }
      mysqli_close($conexion);   
    }
  }
}else{
  echo "Tienes que validar el captcha para continuar.";
  header("HTTP/1.1 404");
  echo "<br><a href='index.php'>Volver a Intentarlo</a>";
}
?>