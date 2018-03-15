<?php
class VisageLivreControler extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('Users_model');

    }

    public function index()
    {
        
        $data['content'] = 'signin'; // template will call 'signin' sub - view
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->vars($data);
        $this->load->view('template');
        
        isset($_SESSION['mode']) ? null : $_SESSION['mode'] = 'connection';
        
        $data['title'] = 'Visage Livre'; // a title to display above the list
        
        if($_SESSION['mode'] == 'connection'){
            $this->conection();
        }//elseif($_SESSION['mode'] == 'User')                Partie qui renverra au controler pour l'utilisateur connecté
            //require('application/controllers/UsersControler.php');
            //$this->load->library();
            //$controler = new UsersControler();
        else{
            
        }
    }
    private function conection()
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
        
        
        
        
    
    
    
    
    
    public function create () {

        $this->load->helper('form');
        $this->load->library('form_validation');
        $data['title'] = 'Cr&eacute;er une t&acirc;che';
        $this->form_validation->set_rules('title','Enonc&eacute;', 'required');
        if ( $this->form_validation->run() === FALSE ) {
            $data['content'] = 'form';
        } else {
            
            $title = $this->input->post('title');
            $this->todo_model->todo_add_task($title );
            $data['content'] = 'add_success';
        }

        $this->load->vars($data);
        $this->load->view('template');
        }
    
    
}
?>
