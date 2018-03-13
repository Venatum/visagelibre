<?php
class UsersControler extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UsersModel');
    }
    
    public function index()
    {
        $data['user'] = $this->UsersModel->getUser() ;
        $data['title'] = 'Todo list'; // a title to display above the list
        $data['content'] = 'task_list'; // template will call ' task_list ' sub - view
        $this->load->vars($data);
        $this->load->view('template');
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

        $this->load->vars($data );
        $this->load->view('template');
        }
    
    
}
?>
