<?php
require_once 'session/session.php';

class SessionController extends Controller{
    private $session;
    private $user;

    public function __construct(){
        parent::__construct();
        $this->init();
    }

    public function init(){
        $this->session = new Session();
    }

    public function existsSession(){
        if(!$this->session->exists()) return false;
        if($this->session->getCurrentUser() == null) return false;

        $userId = $this->session->getCurrentUser();
        return isset($userId);
    }

    public function validateSession(){
        if($this->existsSession()){
            header('Location'. constant('URL'). 'user');
        }else{
            $currentURL = $this->getCurrentPage();
            $currentURL = preg_replace("/\?.*/","",$currentURL);
        
            switch ($currentURL) {
                case 'login':
                    $this->redirect('login',[]);
                    break;
                case 'signup':
                    header('Location: '.constant('URL'). 'signup');
                    break;     
                default:
                    header('Location: '.constant('URL'). '');
                    break;
            }
        }
    }

    function initialize($user){
        $this->session->setCurrentUser($user->getIdUsuario());
        $this->redirect('',[]);
    }

    function getCurrentPage(){
        $actualLink = trim($_SERVER['REQUEST_URI']);
        $url = explode('/', $actualLink);
        return $url[2];
    }

    function logout(){
        $this->session->closeSession();
        $this->redirect('',[]);
    }

    public function getUserSessionData(){
        // $id = $this->session->getCurrentUser();
        // $this->user = new UserModel();
        // $this->user->get($id);
        // return $this->user;
        $userDefault = 'yo';
        return $userDefault;
    }
}

?>