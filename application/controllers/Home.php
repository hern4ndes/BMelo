<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	private $dados = array();

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

        $this->load->model('slider_model', 'slider');
        $this->load->model('categoria_model', 'categoria'); 
        $this->load->model('produto_model', 'produto');
        $this->load->model('testimonial_model', 'testimonial'); 
        $this->load->model('noticia_model', 'noticia');      
	}


	public function index()
	{
		$this->dados['sliders'] = $this->slider->getAll()->result();
		$this->dados['categorias'] = $this->categoria->getAll('descricao', 'asc')->result();
		$this->dados['produtos'] = $this->produto->getAll()->result();
		$this->dados['testimoniais'] = $this->testimonial->getAll()->result();
		$this->dados['noticias'] = $this->noticia->getUltimas()->result();

		$this->load->view('index', $this->dados);
	}
}
