<?php
session_start();
if(!isset($_SESSION['user'])){
  header('Location:login.html');
}

require_once('database/db.php');

$data = new User();
$user = $data->selectAll($_SESSION['user']);

?>

<!DOCYTPE html>
<html>

	<head>

		<meta charset='utf-8'>
		<title>Cadastro de Clientes</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>
           body {
           	padding: 120px;
           }
           .card-title {
           	  text-align:center;
           }
        </style>
	</head>
	<body>
		<div class="card border">
			<div class="card-header">
				<h5 class="card-title"> Cadastro de Clientes </h5>
			</div>
			<div class="card-body">
				<form class="form-group" action="cliente.php" method="POST">
                  <label>Nome </label>
                  <input type="text" class="form-control" name="name"> 
                  <label>Data de Nascimento</label>
                  <input type="date" class="form-control" name="birthday"> 
                  <label >Endereço</label>
                  <input type="text" class="form-control" name="address"> 
                  <input type="hidden" name="attendant" value=<?php 
                    echo $user[0]['id'];
                   ?>>
            </div>
            <div class="card-footer">
                <button type='submit' class='btn btn-primary btn-sm'>Cadastrar</button>
                <?php
                 if($user[0]['adm'] == 0){
                    echo "<a class='btn btn-outline-dark btn-sm' href='acessoUser.php'>Sair </a>";
                  } else {
                     echo "<a class='btn btn-outline-dark btn-sm' href='acessoAdm.php'>Sair </a>";
                  }
                  ?>
            </div>
				</form>	
		</div>
	</body>

</html>