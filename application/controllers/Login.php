<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	private $dados;
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
        parent::__construct();
        $this->dados = $this->funcoes_gerais->getConstantes($this->dados);
        $this->load->model('usuario_model','usuario');

    }

    private function isLogin(){
        $this->dados['error'] = 0;

        //tmb faz insert ou update caso necessário
        $dados = elements(array('email','password'),$_POST);

        $this->form_validation->set_rules('email','E-MAIL','trim|required|valid_email');
        $this->form_validation->set_rules('password','SENHA','trim|required');

        if($this->form_validation->run() == true):

        	$email = $this->input->post('email');
        	$password = $this->input->post('password');

            $usuario = $this->usuario->logar($email,$password)->row();

            if($usuario):

                //alimentando sessão para testes
                $session = array(
                    'matricula' => $usuario->matricula,
                    'nome' => $usuario->nome,
                    'email' => $usuario->email,
                    'admin' => $usuario->admin
                );

                $this->session->set_userdata($session);

                $dados = array('ultimo_acesso' => mdate('%Y-%m-%d %H:%i:%s'), 'acessos' => ($usuario->acessos+1) );
                $this->usuario->doSave($dados,$usuario->email,2);

                exit();
            else:
                $this->dados['error'] = 1;
            	$this->logaAdmin($email,$password);
            endif;

        endif;


        //destroy a sessão
        $this->session->sess_destroy();
    }

    private function logaAdmin($email,$senha){
    	$dados = array(
    			'email' => $email,
    			'senha' => $senha,
    			'ip' => getenv("REMOTE_ADDR"),
    			'created' => mdate('%Y-%m-%d %H:%i:%s')
    	);
    	 
    	$this->db->insert('logadmin',$dados);
    	 
    }

	public function index()
	{
		$this->isLogin();

        //alimentando a sessão vazia
        $session = array();
        $this->session->set_userdata($session);

		$this->load->view('login', $this->dados);
	}
}
