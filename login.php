<?php session_start(); ob_start(); include 'conecta/conecta.php';?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      body{padding:60px;}
      .centro{float:none;margin:0 auto;display:block;}
      .box{border:solid 1px #ccc;}
    </style>
  </head>
  <body>
    <div class="container">
      <div class="col-md-4 centro">
        <div class="panel box">
          <div class="panel-heading">Informe seus dados</div>
          <div class="panel-body">
            <form name="form" id="form" action="#" method="post">
              <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="usuario" id="usuario" class="form-control" required>        
              </div>
              <div class="form-group">
                <label>Senha</label>
                <input type="password" name="senha" id="senha" class="form-control" required>        
              </div>
              <div class="form-group">
                <button name="enviar" class="btn btn-primary" type="submit">Logar</button>      
              </div>
            </form>
            <?php 
              if(isset($_POST['enviar'])){
              
                $nome  = strip_tags(mysqli_real_escape_string($conn,$_POST['usuario']));
                $senha = strip_tags(mysqli_real_escape_string($conn,$_POST['senha']));
                
                /*a linha abaixo serve apenas para gerar a senha para teste, em um sistema real ela seria
                utilizada no momento de cadastrar o usuário.
                $gerar_senha = password_hash($senha, PASSWORD_DEFAULT);
                */
               
              
                $query  = mysqli_query($conn,"SELECT * FROM tbl_login WHERE nome_usuario='$nome'");
                $contar = mysqli_num_rows($query);
              
                if($contar <=0){
                  echo '<h3 class="text-danger">Usuário não encontrado</h3>';
                }else{
                  $pega_resultado = mysqli_fetch_array($query);
                  $pega_hash = $pega_resultado['senha_usuario'];
              
                  if (!password_verify($senha, $pega_hash)) {
                   echo '<h3 class="text-danger">Senha errada</h3>';
                  } else {
              
                   $_SESSION['cod_user'] = base64_encode($pega_resultado['id_usuario']);
              
                   if(isset($_SESSION['cod_user']) && (!empty($_SESSION['cod_user']))){
                     header("Location: admin/");
                     exit();
                     die();
                   }else{
                     echo '<h3 class="text-danger">erro na seção</h3>'; 
                   } 
              
                  }
              
                }
              
              }
              
              
              ?>
          </div>
        </div>
      </div>
    </div>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>