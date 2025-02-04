<?php 
require_once 'db.php';
require_once 'session.php';

abstract class user {
    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $password;
    protected $role;
    protected $status;
    function __construct($nom,$prenom,$email,$role,$id,$password=null,$status=null)
    {
        $this->id=$id;
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->email=$email;
        $this->role=$role;
        $this->password=$password;
        $this->status=$status;
       
    }
    private function setPassword($password){
     $this->password=password_hash($password,PASSWORD_BCRYPT);
    }
    public function __get($attribut) {
        
        if (property_exists($this, $attribut)) {
            return $this->$attribut;
        } else {
           
            echo "L'attribut '$attribut' n'existe pas.";
        }
    }


    abstract static public function login($email, $password);

    private function  insertion(){
        $db=database::getInstance()->getConnection();
        try {
            
                $stmt=$db->prepare("INSERT INTO user(nom, prenom, email, password, role)
                                    Value(?,?,?,?,?)");
                $stmt->execute([$this->nom,$this->prenom,$this->email,$this->password,$this->role]);
                $this->id=$db->lastInsertId();
          


        } catch (PDOException $e) {
           $e->getMessage();
        }
       
    }

    public static function MailExist($email) {
        $db = database::getInstance()->getConnection();
        try {
            $stmt = $db->prepare("SELECT COUNT(*) as count FROM user WHERE email = ?");
            $stmt->execute([$email]);
            $result = $stmt->fetch();
            return $result['count'] > 0;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la vérification de l'email : " . $e->getMessage());
        }
    }

    public static function RoleMail($email) {
        $db = database::getInstance()->getConnection();
        try {
            $stmt = $db->prepare("SELECT role FROM user WHERE email=?");
            if ($stmt->execute([$email])) {
                $result = $stmt->fetch();
                if ($result) {
                    return $result['role'];
                } else {
                   
                    return false;
                }
            } else {
                return false;
            }
        } catch (PDOException $e) {
          
            return false;
        }
    }
    

    private function  StatusEnAttente($iduser){
        $db = database::getInstance()->getConnection();
        try{
            $stmt=$db->prepare("UPDATE user set status='en attente' where  iduser=?");
            $stmt->execute([$iduser]);
            
          }catch(PDOException $e){
  
          }
    }
    private function  StatusActiveEtudiant($iduser){
        $db = database::getInstance()->getConnection();
        try{
            $stmt=$db->prepare("UPDATE user set EstActive=true where  iduser=?");
            $stmt->execute([$iduser]);
            
          }catch(PDOException $e){
  
          }
    }

  

    public static function inscrire($nom,$prenom,$email,$role, $password){
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);// suprimme les caractéres ilegale
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }
        htmlspecialchars(trim($nom));
        htmlspecialchars(trim($prenom));
        $user=new static($nom,$prenom,$email,$role,null,$password);
        $user->setPassword($password);
        if($role=='2'){
            $user->insertion();
            $user->StatusEnAttente($user->id);
            Session::ActiverSession();
            $_SESSION['success'] = "inscription avec success !"; 
            header('location: ../front/connexion.php'); 
            exit();
        }if($role=='1'){
            $user->insertion();
            $user->StatusActiveEtudiant($user->id);
            Session::ActiverSession();
            $_SESSION['success'] = "inscription avec success !"; 
            header('location: ../front/connexion.php'); 
            exit();
        }
    }

    public function logout() {
        // Démarrer la session si elle n'est pas déjà démarrée
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Supprimer toutes les variables de session
        session_unset();
    
        // Détruire la session côté serveur
        session_destroy();
    
        // Supprimer le cookie de session côté client, si utilisé
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 3600, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        }
    
        // Rediriger vers la page de connexion ou une autre page
        header("Location: ../index.php");
        exit(); // Assurez-vous de terminer le script après une redirection
    }
    
}