<?php
class UsersControler extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        echo 'usersmodel';
        $this->load->model('Users_model');
    }
    
    public function index()
    {
        isset($_SESSION['action']) ? null : $_SESSION['action'] = 'signin';
        /*
        $data['user'] = $this->Users_model->getUser() ;
        $data['title'] = 'Todo list'; // a title to display above the list
         // template will call ' task_list ' sub - view
        $this->load->vars($data);
        */
        if($this->Users_model->confirmConnect() == true){
            $this->load->view('template');
            $data['content'] = 'home';
            $_SESSION['mode'] = 'User';
        }else{
            if($_SESSION['action'] == 'register'){
                $data['content'] = 'register';
            }else{
                $data['content'] = 'signin';
            }
        }
        
    }
    
        
}
?>
