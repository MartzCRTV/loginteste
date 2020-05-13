<?php session_start(); ob_start();
  if(!isset($_SESSION['cod_user']) || (empty($_SESSION['cod_user']))){
    header("Location:../login.php?erro=sem-permissao");
    exit();
    die();
  }
  
  if(isset($_GET['sair']) && $_GET['sair'] == 'logout'){
    session_destroy();
    session_unset();
    header("Location:../login.php?status=logout");
    exit();
    die();
  }
  
  include '../conecta/conecta.php';
  
  $id = base64_decode($_SESSION['cod_user']);
  
  $query  = mysqli_query($conn,"SELECT * FROM tbl_login WHERE id_usuario='$id'");
  $contar = mysqli_num_rows($query);
  
  if($contar <=0){
    session_destroy();
    session_unset();
    header("Location:../login.php?erro=usuario-invalido");
    exit();
    die();
  }
  
  $pega_resultado = mysqli_fetch_array($query);
  $nome   = $pega_resultado['nome_usuario'];
  
  
  ?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Area segura</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      body{padding:80px;}
    </style>
  </head>
  <body>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <a class="navbar-brand" href="#">Admin</a>
      <ul class="nav navbar-nav">
        <li class="active">
          <a href="#">Home</a>
        </li>
        <li>
          <a href="?sair=logout">Sair</a>
        </li>
      </ul>
    </nav>
    <div class="container">
      <div class="col-md-12">
        <h1>Olá <?php echo $nome;?></h1>
      </div>
    </div>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>