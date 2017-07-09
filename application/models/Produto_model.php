<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produto_model extends CI_Model {   

    private $tabela = 'produto';

    function __construct() {
        parent::__construct();
    }
    
    private function doInsert($dados = null){
        if($dados):
            $this->db->insert($this->tabela,$dados);
            $this->funcoes_gerais->auditoria($this->tabela,'cadastrar',$dados);
            $this->session->set_flashdata('tipo_msg','success');
            $this->session->set_flashdata('msg','Cadastrado com sucesso.');
            redirect('produto_admin');
        endif;
    }

    private function doUpdate($dados = null,$condicao = null){
        if($dados and $condicao):
            $this->db->update($this->tabela,$dados,$condicao);

            $this->funcoes_gerais->auditoria($this->tabela,'atualizar',$dados,$condicao);
            $this->session->set_flashdata('tipo_msg','success');
            $this->session->set_flashdata('msg','Atualizado com sucesso.');
            redirect('produto_admin');
        endif;
    }

    public function doSave($dados = null, $id = null){

        if (!$id) {
            $this->doInsert($dados);
        } else {
            $this->doUpdate($dados, array('id' => $id));
        }
    }

    public function doDelete($id = null){
        if($id):

            $condicao = array('id' => $id);
            $dados = $this->getById($id)->row();
            $this->db->update($this->tabela,array('status' => 0),$condicao);
            $this->funcoes_gerais->auditoria($this->tabela,'remover',$dados,$condicao);
            $this->session->set_flashdata('tipo_msg','success');
            $this->session->set_flashdata('msg','Removido com sucesso.');
            redirect('produto_admin');
        endif;
    }

    public function recordCountAll(){
        return $this->db->count_all($this->tabela);

    }

    public function getAll() {

        $sql = "select c.descricao as categoria, p.* from ".$this->tabela." p 
        inner join categoria c on c.id = p.categoria_id 
        where c.status = true 
            and p.status = true 
        order by p.created desc";

        return $this->db->query($sql);
    }
    
    public function getById($id = null){
        if($id):
            $this->db->where('id',$id);
            $this->db->limit(1);
            return $this->db->get($this->tabela);
        else:
            return false;
        endif;
    }

    public function getByCategoriaId($categoria_id = null){
        if($categoria_id):
            $this->db->where('categoria_id',$categoria_id);
            return $this->db->get($this->tabela);
        else:
            return false;
        endif;
    }

    public function getByNovidade(){
        $this->db->where('novidade',true);
        return $this->db->get($this->tabela);
    }
}
