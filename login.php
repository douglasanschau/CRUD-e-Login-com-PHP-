<?php

require_once('database/db.php');


class Login {

  public $email;
  public $password;

  public function __construct(){
    $this->email = $_POST['email'];
    $this->password = $_POST['password'];
  }

  public function validate() {
    $email = $this->email; $password = $this->password;
    if(isset($email) && isset($password)){
     $login = new User();
     $user = $login->Access($email, md5($password));
     $this->defineUser($user);
    }
  }

  public function defineUser($user = array()) {
     if(count($user) == 1 && $user[0]['adm'] == 1) {
       $this->admLogin($user);
     } else if (count($user) == 1 && $user[0]['adm'] == 0) {
       $this->userLogin($user);
     } else {
       throw new Exception('E-mail ou senha inválidos!', 401);
     }
  }
 
    public function admLogin($user = array()) {
        session_start();
        $_SESSION['user'] = $user[0]['email'];
        header('Location: acessoAdm.php');
    }


  public function userLogin($user = array()) {
      session_start();
      $_SESSION['user'] = $user[0]['email'];
      header('Location: acessoUser.php');
  }
    
}

$login = new Login();

  try {
    $login->validate();
  } catch(Exception $e){
    $error = [
       'message' => $e->getMessage(),
       'code' => $e->getCode(),
       'line' => $e->getLine()
        ];
      echo $error['message'];
  }

?>