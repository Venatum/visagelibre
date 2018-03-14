<?php
class VisageLivreControler extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('UsersModel');
    }
    
    public function index()
    {
        
        $data['content'] = 'signin'; // template will call 'signin' sub - view
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->vars($data);
        $this->load->view('template');
        
        
        isset($_SESSION['mode']) ? null : $_SESSION['mode'] = 'signin';
        
        $data['user'] = $this->UsersModel->getUser() ;
        $data['title'] = 'Visage Livre'; // a title to display above the list
        
        if($_SESSION['mode'] == 'signin'){
            $this->load->library('../controllers/UsersControler');
            $controler = new $this->UsersControler();
            }
        }elseif($_SESSION['mode'] == 'signin')
        
        $controler->index();
        
        
        
        
        
        
        
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
