<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    private $tabela = 'usuario';

    function __construct(){
        parent::__construct();
    }

    private function doInsert($dados = null){
        if($dados):
            $this->db->insert($this->tabela,$dados);
            $this->funcoes_gerais->auditoria($this->tabela,'cadastrar',$dados);
            $this->session->set_flashdata('tipo_msg','success');
            $this->session->set_flashdata('msg','Cadastrado com sucesso.');
            redirect('usuario');
        endif;
    }

    private function doUpdate($dados = null,$condicao = null,$redirecionar = null){
        if($dados and $condicao):
            $this->db->update($this->tabela,$dados,$condicao);

            $this->funcoes_gerais->auditoria($this->tabela,'atualizar',$dados,$condicao);
            $this->session->set_flashdata('tipo_msg','success');

            switch($redirecionar){
                case 1:
                    $this->session->set_flashdata('msg','Atualizado com sucesso.');
                    redirect('meus_dados');
                    break;
                case 2:
                    $this->session->set_flashdata('msg','Login efetuado com sucesso.');
                    redirect('mensagem');
                    break;
                default :
                     $this->session->set_flashdata('msg','Atualizado com sucesso.');
                     redirect('usuario');
                    break;
            }
        endif;
    }

    public function doSave($dados = null, $id = null, $redirecionar = null){

        if (!$id) {
            $this->doInsert($dados);
        } else {
            $this->doUpdate($dados, array('matricula' => $id), $redirecionar);
        }
    }

    public function doDelete($id = null){
        if($id):

            $condicao = array('matricula' => $id);
            $dados = $this->getById($id)->row();

            $this->db->delete($this->tabela,$condicao);
            $this->funcoes_gerais->auditoria($this->tabela,'remover',$dados,$condicao);
            $this->session->set_flashdata('tipo_msg','success');
            $this->session->set_flashdata('msg','Removido com sucesso.');
            redirect('usuario');
        endif;
    }

    public function recordCountAll(){
        return $this->db->count_all($this->tabela);

    }

    public function getAll(){
        
        $this->db->where(array('status' => 1));
        $this->db->order_by('matricula', 'desc');
        return $this->db->get($this->tabela);

    }

    public function getById($id = null){
        if($id):
            $this->db->where('matricula',$id);
            $this->db->limit(1);
            return $this->db->get($this->tabela);
        else:
            return false;
        endif;
    }

    public function logar($email,$senha){
        if($email and $senha):

            //echo $this->funcoes_gerais->geraSenha($senha, $email); die;
            $this->db->where(
                array('email' => $email,
                        'senha' => $this->funcoes_gerais->geraSenha($senha, $email),
                        'status' => 1
                ));
            $this->db->limit(1);
            return $this->db->get($this->tabela);
        else:
            return false;
        endif;


    }

    public function getByNome($query = null){
        if($query):            
            $this->db->like('nome', $query); 
            $this->db->or_like('matricula', $query); 
            $this->db->order_by('nome', 'asc');
            return $this->db->get($this->tabela);
        else:
            return false;
        endif;
    }

}