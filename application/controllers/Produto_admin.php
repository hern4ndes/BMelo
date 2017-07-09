<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produto_admin extends CI_Controller {

	private $dados = array();
	private $campos = array('id', 'nome','imagem_galeria','imagem_1','imagem_2', 'detalhes',
        'especificacoes','categoria_id', 'novidade');
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

        $this->load->model('produto_model', 'produto');  
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

		$this->dados['registros'] = $this->produto->getAll()->result();
        $this->tratarListagem();

		$this->load->view('produtos_admin', $this->dados);
	}

	private function setaDados() {
        
        $camposDatasDefault = array('created');

        foreach ($this->campos as $key => $campo) {

            if (in_array($campo, $camposDatasDefault)
                    and isset($this->dados['produto']->{$campo})) {
                $valor = $this->funcoes_gerais->converteData($this->dados['produto']->{$campo});
            } else {
                $valor = $this->dados['produto']->{$campo};
            }

            $this->dados['form_' . $campo] = $valor;
        }
        
    }

    private function validarDados() {
        //tmb faz insert ou update caso necessário
        $dados = elements($this->campos, $_POST);
        
        $this->form_validation->set_rules('nome', 'NOME', 'trim|required');
        
        if ($this->form_validation->run() == true) {

            $retorno_do_upload1 = $this->funcoes_gerais->doUpload('imagem_galeria','produto');
            $retorno_do_upload2 = $this->funcoes_gerais->doUpload('imagem_1','produto');
            $retorno_do_upload3 = $this->funcoes_gerais->doUpload('imagem_2','produto');

            if(($retorno_do_upload1 != -1)
                and ($retorno_do_upload2 != -1)
                and ($retorno_do_upload3 != -1)
                ){

                if($retorno_do_upload1 !== 0){
                    $dados['imagem_galeria'] = $retorno_do_upload1;
                    $this->funcoes_gerais->removerFoto('imagem_galeria','produto','produto',$this->input->post('id'));

                }
                else if($retorno_do_upload1 === 0) unset($dados['imagem_galeria']);

                if($retorno_do_upload2 !== 0){
                    $dados['imagem_1'] = $retorno_do_upload2;
                    $this->funcoes_gerais->removerFoto('imagem_1','produto','produto',$this->input->post('id'));

                }
                else if($retorno_do_upload2 === 0) unset($dados['imagem_1']);

                if($retorno_do_upload3 !== 0){
                    $dados['imagem_2'] = $retorno_do_upload3;
                    $this->funcoes_gerais->removerFoto('imagem_2','produto','produto',$this->input->post('id'));

                }
                else if($retorno_do_upload3 === 0) unset($dados['imagem_2']);

                $dados['status'] = 1;
                $dados['created'] = mdate('%Y-%m-%d %H:%i:%s');
                
                if($this->dados['acao'] == 'cadastrar'){             
                    $this->produto->doSave($dados);

                }elseif($this->dados['acao'] == 'atualizar'){
                    $this->produto->doSave($dados, $this->input->post('id'));            
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
        
        $this->load->view('produto_admin',$this->dados);
    }


	public function atualizar() {

        $this->dados['acao'] = 'atualizar';
        
        $produto_criptografada = addslashes($this->uri->segment(3));
        $produto_id = $this->funcoes_gerais->desCriptografar($produto_criptografada);
        
        $this->dados['produto'] = $this->produto->getById($produto_id)->row(); 

        $this->validarDados(); //tmb faz insert ou update caso necessário      

        if ($produto_criptografada) {
            $this->setaDados();
        } elseif ($this->input->post('id')) {
            $this->inicializarVariaveis(); //inicializando as variaveis
        } else {

            $this->session->set_flashdata('tipo_msg', 'warning');
            $this->session->set_flashdata('msg', 'O Registro informado não existe.');
            redirect('produto');
        }

        $this->load->view('produto_admin',$this->dados);
    }

	public function remover(){
        $this->dados['acao'] = 'remover';
        
        //pega o terceiro item da url da pagina
        $tab_id = (int) addslashes($this->funcoes_gerais->desCriptografar($this->uri->segment(3)));

        if($tab_id):
            $this->produto->doDelete($tab_id);

        else:
            $this->session->set_flashdata('tipo_msg','warning');
            $this->session->set_flashdata('msg','O Registro informado não existe.');
            redirect('produto');
        endif;
    }
}
