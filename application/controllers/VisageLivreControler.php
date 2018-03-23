<?php
class VisageLivreControler extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->load->model('Users_model');
        $this->view = 'template';
    }

	/**
	 * @param string $action
	 */
	public function index($action = 'index')
    {


        $_SESSION['action'] = $action;

        
         // template will call 'signin' sub - view
        $this->load->helper('form');
        $this->load->helper('url');

        isset($_SESSION['mode']) ? null : $_SESSION['mode'] = 'connection';
        
        $data['title'] = 'Visage Livre'; // a title to display above the list
        
        if($_SESSION['mode'] == 'user'){
            
            if($_SESSION['action'] == 'signout'){

                $data['content'] = 'signin';
                $this->view = 'template_log';
                unset($_SESSION['user']);
                $_SESSION['mode'] = 'connection';
				header("Location: ".base_url('index.php/VisageLivreControler/index/signin')); // redirection vers la page de connection
            }elseif($_SESSION['action'] == 'deleteAccount'){

				$data['content'] = 'signin';
				$this->view = 'template_log';
				$this->Users_model->deleteAccount();
				unset($_SESSION['user']);
				$_SESSION['mode'] = 'connection';
				header("Location: ".base_url('index.php/VisageLivreControler/index/signin')); // redirection vers la page de connection
			}elseif(isset($_POST['publier'])){
                
				$data['content'] = 'home';
				$this->view = 'template';
				$this->Users_model->addPost($_POST['inputPost'], $_SESSION['user']['nickname']);
				header("Location: ".base_url('index.php/VisageLivreControler/index/home')); // redirection vers la page de home
			}elseif(isset($_POST['comment'])){

				$data['content'] = 'home';
				$this->view = 'template';
                echo($_POST['inputComment'].$_SESSION['user']['nickname'].$_POST['idRef']);
				$this->Users_model->addComment($_POST['inputComment'], $_SESSION['user']['nickname'], $_POST['idRef']);
				header("Location: ".base_url('index.php/VisageLivreControler/index/home')); // redirection vers la page de home
			}elseif(isset($_POST['addFriend'])){

				$data['content'] = 'home';
				$this->view = 'template';
                
				$this->Users_model->addFriend($_SESSION['user']['nickname'], $_POST['addFriend']);
				header("Location: ".base_url('index.php/VisageLivreControler/index/home')); // redirection vers la page de home
			}elseif(isset($_POST['deleteFriend'])){

				$data['content'] = 'home';
				$this->view = 'template';

                $this->Users_model->deleteFriend($_SESSION['user']['nickname'], $_POST['deleteFriend']);
				header("Location: ".base_url('index.php/VisageLivreControler/index/home')); // redirection vers la page de home
			}elseif(isset($_POST['confirmRequest'])){

				$data['content'] = 'home';
				$this->view = 'template';

                $this->Users_model->confirmFriendRequest($_SESSION['user']['nickname'], $_POST['confirmRequest']);
				header("Location: ".base_url('index.php/VisageLivreControler/index/home')); // redirection vers la page de home
			}elseif(isset($_POST['denyRequest'])){

				$data['content'] = 'home';
				$this->view = 'template';

                $this->Users_model->denyFriendRequest($_SESSION['user']['nickname'], $_POST['denyRequest']);
				header("Location: ".base_url('index.php/VisageLivreControler/index/home')); // redirection vers la page de home
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
                    header("Location: ".base_url('index.php/VisageLivreControler/index/home'));

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
                                header("Location: ".base_url('index.php/VisageLivreControler/index/signin'));

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
//        print_r($_POST);
//        print_r($_SESSION);
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
