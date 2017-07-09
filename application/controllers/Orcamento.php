<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orcamento extends CI_Controller {

	private $dados = array();
	private $campos = array('interessado', 'email', 'mensagem', 'telefone');
	private $timeCookie = 0;
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
	public function __construct() {
		parent::__construct();
		$this->dados = $this->funcoes_gerais->getConstantes($this->dados);
		$this->timeCookie = 2 * 3600;
		$this->load->model('mensagem_model', 'mensagem');  
	}

	public function index()
	{

		$this->validarDados(); //tmb faz insert ou update caso necessário
		$this->dados['produtos'] = $_COOKIE['produtos_orcamento_']; 
		
		$this->load->view('orcamento', $this->dados);
	}


    private function validarDados() {
        //tmb faz insert ou update caso necessário
        $dados = elements($this->campos, $_POST);
        
        $this->form_validation->set_rules('interessado', 'INTERESSADO', 'trim|required');
        $this->form_validation->set_rules('email', 'E-MAIL', 'trim|required|valid_email');
        $this->form_validation->set_rules('mensagem', 'MENSAGEM', 'trim|required');
        $this->form_validation->set_rules('telefone', 'TELEFONE', 'trim|required');
                
        if ($this->form_validation->run() == true) {

            $dados['status'] = 1;
            $dados['created'] = mdate('%Y-%m-%d %H:%i:%s');
            setcookie('produtos_orcamento_', "", (time() - $this->timeCookie), '/'); //limpando 

            $this->mensagem->doSave($dados, null, 'orcamento');

        }
    }

    public function addProduto() {

        $this->dados['acao'] = 'cadastrar';

        $this->dados['produto'] = $this->input->post('produto');

        $produtos = $_COOKIE['produtos_orcamento_']; 

        if(empty($produtos)){
        	$produtos = $this->dados['produto'];

        }else{
        	$produtos .= ",\n".$this->dados['produto'];

        }

        setcookie('produtos_orcamento_', $produtos, (time() + ($this->timeCookie)), '/'); //durará 2h
        $this->load->view('add_produto',$this->dados);
    }

}
