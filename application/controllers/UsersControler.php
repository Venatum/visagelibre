<?php
class UsersControler extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UsersModel');
    }
    
    public function index()
    {
        /*
        $data['user'] = $this->UsersModel->getUser() ;
        $data['title'] = 'Todo list'; // a title to display above the list
         // template will call ' task_list ' sub - view
        $this->load->vars($data);
        */
        
        if($this->UsersModel->confirmConnect() == true){
            $this->load->view('template');
            $data['content'] = 'home';
        }
        
        
        
        
        
    }
        
}
?>
