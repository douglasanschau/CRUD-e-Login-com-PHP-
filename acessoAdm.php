<?php
session_start();
if(!isset($_SESSION['user'])){
	header('Location:login.html');
}

require_once('database/db.php');

$data = new User();
$user = $data->selectAll($_SESSION['user']);

?>
<html>
	
	<head>

		<meta charset='utf-8'>
		<title>Cadastro de Usuário Administrador</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>
           body {
           	padding: 120px;
           }
        </style>
	</head>
	<body>
		<div class="card border">
			<div class="card-header">
			 <h5 class="card-title"> Seja Bem Vindo(a) <?php echo $user[0]['name'] ?> </h5>
		   </div>
		   <div class="card-body">
		   	 <h4> Clientes Cadastrados </h4>
             <table class="table table-hover">
               <thead>
               	   <tr class="row">
               	   	 <th class="col">Código Cliente</th>
               	   	 <th class="col">Nome do Cliente</th>
               	   	 <th class="col">Ações</th>
               	   </tr>
               </thead>	
               <tbody>
               	  <?php
                     require_once('database/dbClient.php');
                     $data = new Client();
                     $clients = $data->selectAll();
                     
                     foreach($clients as $client) {

                     	echo "<tr class='row'>".
                     	 "<td class='col'>".$client['id']."</td>".
                     	 "<td class='col'>".$client['name']."</td>".
                     	 "<td class='col'>".
                     	 "<a class='btn btn-outline-primary btn-sm' href='edit.php?id=".$client['id']."'> Editar </a>  ".
                     	 "<a class='btn btn-outline-danger btn-sm' href='delete.php?id=".$client['id']."'> Excluir </a>"."</td>".
                     	 "</tr>";
                     }
               	  ?>
               </tbody>
             </table>
		   </div>
		   <div class="card-footer">
		   	<a class="btn btn-success" href="clientecadastro.php"> Cadastrar Cliente</a>
		   	<a class="btn btn-danger" href="logout.php"> Sair </a>
		   </div>
		</div>
	</body>

</html>