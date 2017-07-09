<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimonial extends CI_Controller {

	private $dados = array();
	private $campos = array('id', 'pessoa', 'foto', 'testemunho', 'funcao');
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

        $this->load->model('testimonial_model', 'testimonial');  
	}

	private function tratarListagem() {

        $listagem = $this->dados['registros'];
        foreach ($listagem as $key => $registro) {

        	$this->dados['registros'][$key]->created = $this->funcoes_gerais->converteData($registro->created);
            
        }
        
    }

	public function index()
	{

		$this->dados['registros'] = $this->testimonial->getAll()->result();
        $this->tratarListagem();

		$this->load->view('testimoniais', $this->dados);
	}

	private function setaDados() {
        
        $camposDatasDefault = array('created');
        foreach ($this->campos as $key => $campo) {

            if (in_array($campo, $camposDatasDefault)
                    and isset($this->dados['testimonial']->{$campo})) {
                $valor = $this->funcoes_gerais->converteData($this->dados['testimonial']->{$campo});
            } else {
                $valor = $this->dados['testimonial']->{$campo};
            }

            $this->dados['form_' . $campo] = $valor;
        }
        
    }

    private function validarDados() {
        //tmb faz insert ou update caso necessário
        $dados = elements($this->campos, $_POST);
        
        $this->form_validation->set_rules('pessoa', 'PESSOA', 'trim|required');
        $this->form_validation->set_rules('testemunho', 'TESTEMUNHO', 'trim|required');
        $this->form_validation->set_rules('funcao', 'FUNÇÃO', 'trim|required');
                
        if ($this->form_validation->run() == true) {

            $retorno_do_upload = $this->funcoes_gerais->doUpload('foto','testimonial');

            if($retorno_do_upload != -1){

                if($retorno_do_upload !== 0){
                    $dados['foto'] = $retorno_do_upload;
                    $this->funcoes_gerais->removerFoto('foto','testimonial','testimonial',$this->input->post('id'));

                }
                else if($retorno_do_upload === 0) unset($dados['foto']);

                $dados['status'] = 1;
                $dados['created'] = mdate('%Y-%m-%d %H:%i:%s');
                
                if($this->dados['acao'] == 'cadastrar'){                
                    $this->testimonial->doSave($dados);

                }elseif($this->dados['acao'] == 'atualizar'){
                    $this->testimonial->doSave($dados, $this->input->post('id'));            
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
        $this->dados['acao'] = 'cadastrar';

        $this->validarDados(); //tmb faz insert ou update caso necessário

        $this->inicializarVariaveis(); //inicializando as variaveis
        
        $this->load->view('testimonial',$this->dados);
    }


	public function atualizar() {

        $this->dados['acao'] = 'atualizar';
        
        $testimonial_criptografada = addslashes($this->uri->segment(3));
        $testimonial_id = $this->funcoes_gerais->desCriptografar($testimonial_criptografada);
        
        $this->dados['testimonial'] = $this->testimonial->getById($testimonial_id)->row(); 


        $this->validarDados(); //tmb faz insert ou update caso necessário      

        if ($testimonial_criptografada) {
            $this->setaDados();
        } elseif ($this->input->post('id')) {
            $this->inicializarVariaveis(); //inicializando as variaveis
        } else {

            $this->session->set_flashdata('tipo_msg', 'warning');
            $this->session->set_flashdata('msg', 'O Registro informado não existe.');
            redirect('testimonial');
        }

        $this->load->view('testimonial',$this->dados);
    }

	public function remover(){
        $this->dados['acao'] = 'remover';
        
        //pega o terceiro item da url da pagina
        $tab_id = (int) addslashes($this->funcoes_gerais->desCriptografar($this->uri->segment(3)));

        if($tab_id):
            $this->testimonial->doDelete($tab_id);

        else:
            $this->session->set_flashdata('tipo_msg','warning');
            $this->session->set_flashdata('msg','O Registro informado não existe.');
            redirect('testimonial');
        endif;
    }
}
