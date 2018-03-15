<?php
class VisageLivreControler extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('Users_model');
        $this->view = 'template';
    }

    public function index($action = 'signin')
    {
        print_r($_POST);
        print_r($_SESSION);
         // template will call 'signin' sub - view
        $this->load->helper('form');
        $this->load->helper('url');

        isset($_SESSION['mode']) ? null : $_SESSION['mode'] = 'connection';
        
        $data['title'] = 'Visage Livre'; // a title to display above the list
        
        if($_SESSION['mode'] == 'connection'){
            //$this->connection($action);
            isset($_SESSION['action']) ?  : $_SESSION['action'] = 'signin';

            
            $_SESSION['action'] = $action;
            
            /*
            $data['user'] = $this->Users_model->getUser() ;
            $data['title'] = 'Todo list'; // a title to display above the list
             // template will call ' task_list ' sub - view
            $this->load->vars($data);
            */
            if(isset($_POST['connection'])){
                if($this->Users_model->confirmConnect() == true){
                    $data['content'] = 'home';
                    //$this->view = 'template';
                    $_SESSION['mode'] = 'user';
                    $this->view = 'template';

                }else{
                    $this->view = 'template_log';
                    $data['content'] = 'signin';
                }

            }else{
                if($_SESSION['action'] == 'register'){
                    $data['content'] = 'register';
                }else{
                    $data['content'] = 'signin';
                }

                $this->view = 'template_log';
            }
        }
        $this->load->vars($data);
        $this->load->view($this->view);
        //elseif($_SESSION['mode'] == 'User')                Partie qui renverra au controler pour l'utilisateur connecté
            //require('application/controllers/UsersControler.php');
            //$this->load->library();
            //$controler = new UsersControler();
        
        


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
