<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	private $dados = array();
	private $campos = array('matricula','nome', 'email', 'senha', 'ultimo_acesso', 'acessos');
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
        $this->funcoes_gerais->isAutenticado($this);

        $this->load->model('usuario_model', 'usuario');  
	}

	private function tratarListagem() {

        $listagem = $this->dados['registros'];
        foreach ($listagem as $key => $registro) {

        	$this->dados['registros'][$key]->created = $this->funcoes_gerais->converteData($registro->created);
            
        }
        
    }

	public function index()
	{

		$this->dados['registros'] = $this->usuario->getAll()->result();
        $this->tratarListagem();

		$this->load->view('usuarios', $this->dados);
	}

	private function setaDados() {
        
        $camposDatasDefault = array('ultimo_acesso');
        foreach ($this->campos as $key => $campo) {

            if (in_array($campo, $camposDatasDefault)
                    and isset($this->dados['usuario']->{$campo})) {
                $valor = $this->funcoes_gerais->converteData($this->dados['usuario']->{$campo});
            } else {
                $valor = $this->dados['usuario']->{$campo};
            }

            $this->dados['form_' . $campo] = $valor;
        }
        
    }

    private function validarDados() {
        //tmb faz insert ou update caso necessário
        $dados = elements($this->campos, $_POST);
        
        $this->form_validation->set_rules('nome', 'NOME', 'trim|required');
        if($this->dados['acao'] == 'cadastrar'){
            $this->form_validation->set_rules('email', 'E-MAIL', 'trim|required|valid_email|is_unique[usuario.email]');
        }else{
            $this->form_validation->set_rules('email', 'E-MAIL', 'trim|required|valid_email');
            
        }

        $this->form_validation->set_rules('senha', 'SENHA', 'trim|required|matches[re_senha]');
        $this->form_validation->set_rules('re_senha', 'REPETIR SENHA', 'trim|required');
                
        if ($this->form_validation->run() == true) {

            $dados['senha'] = $this->funcoes_gerais->geraSenha($dados['senha'], $dados['email']);
            $dados['admin'] = $dados['status'] = 1;
            $dados['created'] = mdate('%Y-%m-%d %H:%i:%s');

            if($this->dados['acao'] == 'cadastrar'){
                $this->usuario->doSave($dados);

            }elseif($this->dados['acao'] == 'atualizar'){
                $this->usuario->doSave($dados, $this->input->post('matricula'));            
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
        
        $this->load->view('usuario',$this->dados);
    }


	public function atualizar() {

        $this->dados['acao'] = 'atualizar';
        
        $usuario_criptografada = addslashes($this->uri->segment(3));
        $usuario_id = $this->funcoes_gerais->desCriptografar($usuario_criptografada);
        

        $this->dados['usuario'] = $this->usuario->getById($usuario_id)->row(); 

        $this->validarDados(); //tmb faz insert ou update caso necessário      

        if ($usuario_criptografada) {
            $this->setaDados();
        } elseif ($this->input->post('matricula')) {
            $this->inicializarVariaveis(); //inicializando as variaveis
        } else {

            $this->session->set_flashdata('tipo_msg', 'warning');
            $this->session->set_flashdata('msg', 'O Registro informado não existe.');
            redirect('usuario');
        }

        $this->load->view('usuario',$this->dados);
    }

	public function remover(){
        $this->dados['acao'] = 'remover';
        
        //pega o terceiro item da url da pagina
        $tab_id = (int) addslashes($this->funcoes_gerais->desCriptografar($this->uri->segment(3)));

        if($tab_id):

            $this->usuario->doDelete($tab_id);

        else:
            $this->session->set_flashdata('tipo_msg','warning');
            $this->session->set_flashdata('msg','O Registro informado não existe.');
            redirect('usuario');
        endif;
    }
}
