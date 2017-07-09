<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Institucional extends CI_Controller {

	private $dados = array();
	private $campos = array('id', 'nome','titulo','texto_sobre','texto_encontre_nos',
    'telefones','email','funcionamento','link_facebook','link_instagram','link_twitter',
    'texto_slide','texto_rodape','imagem_sobre_nos', 'titulo_texto_index', 'texto_index');
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

        $this->load->model('institucional_model', 'institucional');  
	}

	private function tratarListagem() {

        $listagem = $this->dados['registros'];
        foreach ($listagem as $key => $registro) {

        	$this->dados['registros'][$key]->created = $this->funcoes_gerais->converteData($registro->created);
            
        }
        
    }

	public function index()
	{

		$this->dados['registros'] = $this->institucional->getAll()->result();
        $this->tratarListagem();

		$this->load->view('institucionais', $this->dados);
	}

	private function setaDados() {
        
        $camposDatasDefault = array('created');
        foreach ($this->campos as $key => $campo) {

            if (in_array($campo, $camposDatasDefault)
                    and isset($this->dados['institucional']->{$campo})) {
                $valor = $this->funcoes_gerais->converteData($this->dados['institucional']->{$campo});
            } else {
                $valor = $this->dados['institucional']->{$campo};
            }

            $this->dados['form_' . $campo] = $valor;
        }
        
    }

    private function validarDados() {
        //tmb faz insert ou update caso necessário
        $dados = elements($this->campos, $_POST);
        
        $this->form_validation->set_rules('nome', 'NOME', 'trim|required');
        $this->form_validation->set_rules('titulo', 'TÍTULO', 'trim|required');
        $this->form_validation->set_rules('texto_sobre', 'SOBRE', 'trim|required');
        $this->form_validation->set_rules('texto_encontre_nos', 'ENCONTRE-NOS', 'trim|required');
        $this->form_validation->set_rules('telefones', 'TELEFONES', 'trim|required');
        $this->form_validation->set_rules('email', 'E-MAIL', 'trim|required|valid_email');
                
        if ($this->form_validation->run() == true) {

            $retorno_do_upload = $this->funcoes_gerais->doUpload('imagem_sobre_nos','institucional');

            if($retorno_do_upload != -1){

                if($retorno_do_upload !== 0){
                    $dados['imagem_sobre_nos'] = $retorno_do_upload;
                    $this->funcoes_gerais->removerFoto('imagem_sobre_nos','institucional','institucional',$this->input->post('id'));

                }
                else if($retorno_do_upload === 0) unset($dados['imagem_sobre_nos']);

                $dados['status'] = 1;
                $dados['created'] = mdate('%Y-%m-%d %H:%i:%s');
                
                if($this->dados['acao'] == 'cadastrar'){                
                    $this->institucional->doSave($dados);

                }elseif($this->dados['acao'] == 'atualizar'){
                    $this->institucional->doSave($dados, $this->input->post('id'));            
                }

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
        redirect('institucional');
    }


	public function atualizar() {

        $this->dados['acao'] = 'atualizar';
        
        $institucional_criptografada = addslashes($this->uri->segment(3));
        $institucional_id = $this->funcoes_gerais->desCriptografar($institucional_criptografada);
        
        $this->dados['institucional'] = $this->institucional->getById($institucional_id)->row(); 
 

        $this->validarDados(); //tmb faz insert ou update caso necessário      

        if ($institucional_criptografada) {
            $this->setaDados();
        } elseif ($this->input->post('id')) {
            $this->inicializarVariaveis(); //inicializando as variaveis
        } else {

            $this->session->set_flashdata('tipo_msg', 'warning');
            $this->session->set_flashdata('msg', 'O Registro informado não existe.');
            redirect('institucional');
        }

        $this->load->view('institucional',$this->dados);
    }

	public function remover(){
        redirect('institucional');
    }
}
