<?php 

session_start();

if(!isset($_SESSION['user'])){
	header('Location:login.html');
}

require_once('database/db.php');
require_once('database/dbClient.php');

Class Delete {

	public $id; 

	public function __construct() {
		$this->id = $_GET['id'];
	}

    public function setId() {
    	$id = $this->id;
    	$this->deleteClient($id);
    }

    public function deleteClient($id){
    	if(isset($id)) {
    		$client = new Client();
    		$client->delete($id);
            $this->redirectUser();
    	} else {
    		throw new Exception('Não foi possível deletar esse cliente!', 500);
    	}
    }

    public function redirectUser() {
		$data = new User();
		$user = $data->selectAll($_SESSION['user']);
		 if($user[0]['adm'] == 0){
		 	header('Location:acessoUser.php');
		 } else if ($user[0]['adm'] == 1) {
		 	header('Location:acessoAdm.php');
         }
	}

}

$delete = new Delete();

   try {
   	$delete->setId();
   } catch (Exception $e) {
   	   $error  = [
          'message' => $e->getMessage(),
          'code' => $e->getCode(),
       	  'line' => $e->getLine()
   	   ];
   	   echo $error['message'];
   }


?>