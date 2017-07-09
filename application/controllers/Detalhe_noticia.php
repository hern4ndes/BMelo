<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detalhe_noticia extends CI_Controller {

	private $dados = array();
	private $campos = array('id', 'titulo','autor','texto', 'imagem', 'created');
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
        
        $this->load->model('noticia_model', 'noticia'); 
	}

	public function index()	{

		redirect('home');
	}

	private function setaDados() {
        
        $camposDatasDefault = array('created');
        foreach ($this->campos as $key => $campo) {

            if (in_array($campo, $camposDatasDefault)
                    and isset($this->dados['noticia']->{$campo})) {
                $valor = $this->funcoes_gerais->converteData($this->dados['noticia']->{$campo});
            } else {
                $valor = $this->dados['noticia']->{$campo};
            }

            $this->dados['form_' . $campo] = $valor;
        }
        
    }


	public function visualizar() {
        
        $noticia_criptografada = addslashes($this->uri->segment(3));
        $noticia_id = $this->funcoes_gerais->desCriptografar($noticia_criptografada);

        
        $this->dados['noticia'] = $this->noticia->getById($noticia_id)->row(); 

        if ($noticia_criptografada) {
            $this->setaDados();
        } else {

            $this->session->set_flashdata('tipo_msg', 'warning');
            $this->session->set_flashdata('msg', 'O Registro informado não existe.');
            redirect('home');
        }

        $this->load->view('detalhe_noticia',$this->dados);
    }

}
