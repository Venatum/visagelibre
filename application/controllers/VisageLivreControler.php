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
            
            isset($_SESSION['action']) ?  : $_SESSION['action'] = 'signin';
            
            $_SESSION['action'] = $action;
            
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
            }elseif(isset($_POST['creation'])){
                try{
                    $this->Users_model->addUser($_POST['userName'], $_POST['userPassword'], $_POST['userEmail']);
                }catch(Exception $e){
                    echo $e;
                }
                    $data['content'] = 'signin';
                $this->view = 'template';
            }else{
                if($_SESSION['action'] == 'register'){
                    $data['content'] = 'register';
                }else{
                    $data['content'] = 'signin';
                }

                $this->view = 'template_log';
            }
        }elseif($_SESSION['mode'] == 'user'){
            
            
            
            
            
        }else{
            $_SESSION['mode'] = 'connection';
        }
        
        
        
        
        
        $this->load->vars($data);
        $this->load->view($this->view);

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
