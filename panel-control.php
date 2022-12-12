<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
   echo "Login to access this content.<br>";
   echo "<br><a href='index.php'>Login</a>";
   header('Location: index.php');//redirige a la página de login si el usuario quiere ingresar sin iniciar sesion


exit;
}

$now = time();

if($now > $_SESSION['expire']) {
session_destroy();
header('Location: index.php');//redirige a la página de login, modifica la url a tu conveniencia
echo "Your session has expired,
<a href='index.php'>Login</a>";
exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Perfil</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css"> 
  a:link 
  { 
  text-decoration:none; 
  } 
  </style>

</head>
<body>

<div class="jumbotron text-center">
  <h1>Welcome <?php echo  $_SESSION['username'];?></h1>
  <p>Keep your profile updated!</p> 
  <a href="logout.php"><button type="button" class="btn btn-success">Logout</button></a>
</div>
  

</div>

</body>
</html>