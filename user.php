<?php 
 require_once('database/db.php');

 Class UserConnect {

    public $name;
    public $email;
    public $password;
    public $adm;

    public function __construct(){
        $this->name = $_POST['name'];
        $this->email = $_POST['email'];
        $this->password = $_POST['password'];
        $this->adm = $_POST['adm'];
    
    }

    public function createUser($name,$password,$email,$adm) {
        $user = new User();
        $user->setName($name);
        $user->setPassword(md5($password));
        $user->setEmail($email);
        $user->setAdm($adm);
        $user->insert();
    }

    public function setValues(){
        $name = $this->name; $password = $this->password; 
        $email = $this->email; $adm = $this->adm;
        if($adm == 0 && ($email != null) && ($name != null) && ($password != null)) {
            $this->createUser($name,$password, $email, $adm);
            session_start();
            $_SESSION['user'] =  $email;
            header('Location: acessoUser.php');
        } else {
           throw new Exception("Cadastro Inválido!", 406);  
        }
    }

 }

 $firstAccess = new UserConnect();

        try {
             $firstAccess->setValues();
        } catch(Exception $e) {
            $error = [
              'message' => $e->getMessage(),
              'code' => $e->getCode(),
              'line' => $e->getLine()
            ];
            echo $error['message'];
        }

?>