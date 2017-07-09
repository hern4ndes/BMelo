<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

	private $dados = array();
	private $campos = array('id','descricao', 'created');
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

        $this->load->model('categoria_model', 'categoria');  
	}

	private function tratarListagem() {

        $listagem = $this->dados['registros'];
        foreach ($listagem as $key => $registro) {

        	$this->dados['registros'][$key]->created = $this->funcoes_gerais->converteData($registro->created);
            
        }
        
    }

	public function index()
	{

		$this->dados['registros'] = $this->categoria->getAll()->result();
        $this->tratarListagem();

		$this->load->view('categorias', $this->dados);
	}

	private function setaDados() {
        
        $camposDatasDefault = array('created');
        foreach ($this->campos as $key => $campo) {

            if (in_array($campo, $camposDatasDefault)
                    and isset($this->dados['categoria']->{$campo})) {
                $valor = $this->funcoes_gerais->converteData($this->dados['categoria']->{$campo});
            } else {
                $valor = $this->dados['categoria']->{$campo};
            }

            $this->dados['form_' . $campo] = $valor;
        }
        
    }

    private function validarDados() {
        //tmb faz insert ou update caso necessário
        $dados = elements($this->campos, $_POST);
        
        $this->form_validation->set_rules('descricao', 'DESCRIÇÃO', 'trim|required');
                
        if ($this->form_validation->run() == true) {

            $dados['status'] = 1;
            $dados['created'] = mdate('%Y-%m-%d %H:%i:%s');    
            if($this->dados['acao'] == 'cadastrar'){            
                $this->categoria->doSave($dados);

            }elseif($this->dados['acao'] == 'atualizar'){
                $this->categoria->doSave($dados, $this->input->post('id'));            
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
        
        $this->load->view('categoria',$this->dados);
    }


	public function atualizar() {

        $this->dados['acao'] = 'atualizar';
        
        $categoria_criptografada = addslashes($this->uri->segment(3));
        $categoria_id = $this->funcoes_gerais->desCriptografar($categoria_criptografada);
        

        $this->dados['categoria'] = $this->categoria->getById($categoria_id)->row(); 

        $this->validarDados(); //tmb faz insert ou update caso necessário      

        if ($categoria_criptografada) {
            $this->setaDados();
        } elseif ($this->input->post('id')) {
            $this->inicializarVariaveis(); //inicializando as variaveis
        } else {

            $this->session->set_flashdata('tipo_msg', 'warning');
            $this->session->set_flashdata('msg', 'O Registro informado não existe.');
            redirect('categoria');
        }

        $this->load->view('categoria',$this->dados);
    }

	public function remover(){
        $this->dados['acao'] = 'remover';
        
        //pega o terceiro item da url da pagina
        $tab_id = (int) addslashes($this->funcoes_gerais->desCriptografar($this->uri->segment(3)));

        if($tab_id):

            $this->categoria->doDelete($tab_id);

        else:
            $this->session->set_flashdata('tipo_msg','warning');
            $this->session->set_flashdata('msg','O Registro informado não existe.');
            redirect('categoria');
        endif;
    }
}
