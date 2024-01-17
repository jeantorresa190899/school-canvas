<?php
require_once 'session/sessionController.php';

class Main extends SessionController{

    private $user;

    function __construct(){
        parent::__construct();

        $this->session = new SessionController();
        if($this->session->existsSession()){
            $this->user = $this->session->getUserSessionData();
        }
    }

    function render(){
        $this->view->render('main/index',[
            'user' => $this->user
        ]);
    }
}

?>