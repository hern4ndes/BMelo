<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mensagem extends CI_Controller {

	private $dados = array();
	private $campos = array('interessado', 'email', 'mensagem', 'telefone', 'created');
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

        $this->load->model('mensagem_model', 'mensagem');  
	}

	private function tratarListagem() {

        $listagem = $this->dados['registros'];
        foreach ($listagem as $key => $registro) {

        	$this->dados['registros'][$key]->created = $this->funcoes_gerais->converteData($registro->created);
            
        }
        
    }

	public function index()
	{

		$this->dados['registros'] = $this->mensagem->getAll()->result();
        $this->tratarListagem();

		$this->load->view('mensagens', $this->dados);
	}

	private function setaDados() {
        
        $camposDatasDefault = array('created');
        foreach ($this->campos as $key => $campo) {

            if (in_array($campo, $camposDatasDefault)
                    and isset($this->dados['mensagem']->{$campo})) {
                $valor = $this->funcoes_gerais->converteData($this->dados['mensagem']->{$campo});
            } else {
                $valor = $this->dados['mensagem']->{$campo};
            }

            $this->dados['form_' . $campo] = $valor;
        }
        
    }


	public function visualizar() {
        
        $mensagem_criptografada = addslashes($this->uri->segment(3));
        $mensagem_id = $this->funcoes_gerais->desCriptografar($mensagem_criptografada);

        $this->dados['mensagem'] = $this->mensagem->getById($mensagem_id)->row();     
  

        if ($mensagem_criptografada) {
            $this->setaDados();
        } else {

            $this->session->set_flashdata('tipo_msg', 'warning');
            $this->session->set_flashdata('msg', 'O Registro informado não existe.');
            redirect('mensagem');
        }

        $this->load->view('mensagem',$this->dados);
    }

	public function remover(){
        $this->dados['acao'] = 'remover';
        
        //pega o terceiro item da url da pagina
        $tab_id = (int) addslashes($this->funcoes_gerais->desCriptografar($this->uri->segment(3)));

        if($tab_id):

            $this->mensagem->doDelete($tab_id);

        else:
            $this->session->set_flashdata('tipo_msg','warning');
            $this->session->set_flashdata('msg','O Registro informado não existe.');
            redirect('mensagem');
        endif;
    }
}
