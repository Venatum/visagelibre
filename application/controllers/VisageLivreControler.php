<?php
class VisageLivreControler extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('Users_model');
        $this->view = 'template';
    }

    public function index($action = 'index')
    {


        $_SESSION['action'] = $action;

        
         // template will call 'signin' sub - view
        $this->load->helper('form');
        $this->load->helper('url');

        isset($_SESSION['mode']) ? null : $_SESSION['mode'] = 'connection';
        
        $data['title'] = 'Visage Livre'; // a title to display above the list
        
        if($_SESSION['mode'] == 'user'){
            if($_POST['connection']){
                
            }elseif($_SESSION['action'] == 'signout'){
                
                $data['content'] = 'signin';
                $this->view = 'template_log';
                unset($_SESSION['user']);
                $_SESSION['mode'] = 'connection';

            }else{
                $data['content'] = 'home';
                $this->view = 'template';
                
            }
            
            
            
        }elseif($_SESSION['mode'] == 'connection'){
            
            isset($_SESSION['action']) ?  : $_SESSION['action'] = 'signin';
            
            
            if(isset($_POST['connection'])){
                if($this->Users_model->confirmConnect() == true){
                    $data['content'] = 'home';

                    $_SESSION['mode'] = 'user';
                    $this->view = 'template';

                }else{
                    $this->view = 'template_log';
                    $data['content'] = 'signin';
                }
                unset($_SESSION['action']);
            }elseif(isset($_POST['creation'])){
                try{
                    $this->Users_model->addUser($_POST['userName'], $_POST['userPassword'], $_POST['userEmail']);
                }catch(Exception $e){
                    echo $e;
                }
                    $data['content'] = 'signin';
                $this->view = 'index.php';
            }else{
                if($_SESSION['action'] == 'register'){
                    $data['content'] = 'register';
                }else{
                    $data['content'] = 'signin';
                }

                $this->view = 'template_log';
            }
        }else{
            $_SESSION['mode'] = 'connection';
        }
        
        
        
        
        
        $this->load->vars($data);
        $this->load->view($this->view);
        print_r($_POST);
        print_r($_SESSION);
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
