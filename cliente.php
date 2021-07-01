<?php

session_start();

if(!isset($_SESSION['user'])){
	header('Location:login.html');
}

require_once('database/db.php');
require_once('database/dbClient.php');

Class CreateClient {

	public $name;
	public $birthday;
	public $address;
	public $attendant;

	public function __construct(){
		$this->name = $_POST['name'];
		$this->birthday = $_POST['birthday'];
		$this->address =  $_POST['address'];
		$this->attendant = $_POST['attendant'];
	}

	public function setValues(){
		$name = $this->name;
		$birthday = $this->birthday;
		$address = $this->address;
		$attendant = $this->attendant;
		$this->createClient($name, $birthday, $address, $attendant);
	}

	public function createClient($name, $birthday, $address, $attendant) {
		if(($name!= null) && ($birthday != null) && ($address != null) && isset($attendant)) {
			$client = new Client();
			$client->setName($name);
			$client->setBirthday($birthday);
			$client->setAddress($address);
			$client->setAttendant($attendant);
			$client->insert();
			$this->redirectUser();
		} else {
			throw new Exception('Não foi possível cadastrar o cliente!', 500);
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

$client = new CreateClient();


    try {
    	$client->setValues();
    } catch (Exception $e){
    	$error = [
          'message' => $e->getMessage(),
          'code' => $e->getCode(),
       	  'line' => $e->getLine()
   	   ];
   	   echo $error['message'];
    }


?>