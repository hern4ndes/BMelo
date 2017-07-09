<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Interessado extends CI_Controller {

	private $dados = array();
	private $campos = array('id','email', 'created');
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
        
        $this->load->model('interessado_model', 'interessado');  
	}

	private function tratarListagem() {

        $listagem = $this->dados['registros'];
        foreach ($listagem as $key => $registro) {

        	$this->dados['registros'][$key]->created = $this->funcoes_gerais->converteData($registro->created);
            
        }
        
    }

	public function index()
	{

        $this->funcoes_gerais->isAutenticado($this);
		$this->dados['registros'] = $this->interessado->getAll()->result();
        $this->tratarListagem();

		$this->load->view('interessados', $this->dados);
	}

	private function setaDados() {
        
        $camposDatasDefault = array('created');
        foreach ($this->campos as $key => $campo) {

            if (in_array($campo, $camposDatasDefault)
                    and isset($this->dados['interessado']->{$campo})) {
                $valor = $this->funcoes_gerais->converteData($this->dados['interessado']->{$campo});
            } else {
                $valor = $this->dados['interessado']->{$campo};
            }

            $this->dados['form_' . $campo] = $valor;
        }
        
    }

    private function validarDados() {
        //tmb faz insert ou update caso necessário
        $dados = elements($this->campos, $_POST);
        
        $this->form_validation->set_rules('email', 'E-MAIL', 'trim|required|valid_email|is_unique[interessado.email]');
                
        if ($this->form_validation->run() == true) {

            $dados['status'] = 1;
            $dados['created'] = mdate('%Y-%m-%d %H:%i:%s');    
            if($this->dados['acao'] == 'cadastrar'){            
                $this->interessado->doSave($dados);

            }elseif($this->dados['acao'] == 'atualizar'){
                $this->interessado->doSave($dados, $this->input->post('id'));            
            }
                              
        }
    }

    private function inicializarVariaveis() {
        foreach ($this->campos as $key => $campo) {

            $valor = $this->input->post($campo);
            $this->dados['form_' . $campo] = $valor;
        }
        
    }

    public function cadastrar() {

        $this->dados['acao'] = 'cadastrar';

        $this->validarDados(); //tmb faz insert ou update caso necessário

        $this->inicializarVariaveis(); //inicializando as variaveis
        
        $this->load->view('interessado',$this->dados);
    }


	public function atualizar() {
        redirect('interessado');

    }

	public function remover(){
        redirect('interessado');
        
    }
}
