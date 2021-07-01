<?php
session_start();
if(!isset($_SESSION['user'])){
  header('Location:login.html');
}

require_once('database/db.php');
require_once('database/dbClient.php');

$data = new User();
$user = $data->selectAll($_SESSION['user']);

$clients = new Client();
$id = $_GET['id'];
$client = $clients->selectOne($id);

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
				<h5 class="card-title"> Atualização de Cadastro </h5>
			</div>
			<div class="card-body">
				<form class="form-group" action="update.php" method="POST">
                  <input type="hidden" name="id" value=<?php echo $id ?> >
                  <label>Nome </label>
                  <input type="text" class="form-control" name="name" value=<?php echo json_encode($client[0]['name'], JSON_UNESCAPED_UNICODE) ?>> 
                  <label>Data de Nascimento</label>
                  <input type="date" class="form-control" name="birthday" value=<?php echo json_encode($client[0]['birthday'], JSON_UNESCAPED_UNICODE) ?>> 
                  <label >Endereço</label>
                  <input type="text" class="form-control" name="address" value= <?php echo json_encode($client[0]['address'], JSON_UNESCAPED_UNICODE) ?>> 
                  <label>Atendente</label>
                  <input type="text" name="attendant" value=<?php $userAttendant = $data->selectOne($client[0]['attendant']);  echo json_encode($userAttendant[0]['name'], JSON_UNESCAPED_UNICODE) ?> class="form-control" readonly>
            </div>
            <div class="card-footer">
                <button type='submit' class='btn btn-primary btn-sm'>Salvar</button>
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