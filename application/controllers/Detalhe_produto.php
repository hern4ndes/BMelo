<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detalhe_produto extends CI_Controller {

	private $dados = array();
	private $campos = array('id', 'nome','imagem_galeria','imagem_1','imagem_2', 'detalhes',
        'especificacoes','categoria_id');
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

        $this->load->model('produto_model', 'produto');  
        $this->load->model('categoria_model', 'categoria');  
	}

    public function index() {

        redirect('home');
    }

	private function tratarListagem() {

        $listagem = $this->dados['registros'];
        foreach ($listagem as $key => $registro) {

        	$this->dados['registros'][$key]->created = $this->funcoes_gerais->converteData($registro->created);
            
        }
        
    }

    public function visulizar()	{

        $produto_criptografado = addslashes($this->uri->segment(3));
        $produto_id = $this->funcoes_gerais->desCriptografar($produto_criptografado); 

        $this->dados['registros'] = $this->produto->getById($produto_id)->result();

      	$this->dados['categoria'] = $this->categoria->getById($this->dados['registros'][0]->categoria_id)->row();  

        $this->tratarListagem();

		$this->load->view('produto', $this->dados);
	}

	public function por_categoria()	{

        $categoria_criptografada = addslashes($this->uri->segment(3));
        $categoria_id = $this->funcoes_gerais->desCriptografar($categoria_criptografada);
        
		$this->dados['categoria'] = $this->categoria->getById($categoria_id)->row();  

		$this->dados['registros'] = $this->produto->getByCategoriaId($categoria_id)->result();


        $this->tratarListagem();

		$this->load->view('produto', $this->dados);
	}

	public function novidades()	{

        $this->dados['registros'] = $this->produto->getByNovidade()->result();

        $this->tratarListagem();

		$this->load->view('produto', $this->dados);
	}


 
}
