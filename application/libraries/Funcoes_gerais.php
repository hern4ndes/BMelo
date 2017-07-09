<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Funcoes_gerais {

    private $CI;

    public function __construct(){
        $this->CI =& get_instance();
    }

    public function isAutenticado($objeto){

        if ( !$objeto->session->userdata('matricula')):
            redirect('login');
            exit('Faça login!');
        endif;

    }

    public function getConstantes($dados){

        $this->CI->load->model('institucional_model', 'institucional');
        $dados['institucional'] = $this->CI->institucional->getAll()->row();
        return $dados;

    }

    
    public function auditoria($tabela = null,$acao = null,$dados = array(),$condicao = array()){
        if($tabela && $acao):
            //tratamento do conteudo da auditoria
            $conteudo = "";
            foreach($dados as $indice => $registro):
                if($indice != 'senha')
                    $conteudo .= $indice.': '.$registro.' /';
            endforeach;

            if(count($condicao) > 0)  $conteudo .= 'condicao: ';

            foreach($condicao as $indice => $registro):
                $conteudo .= $indice.': '.$registro.' /';
            endforeach;

            //fim tratamento

            $admin = 1;
            $usuario_matricula = $this->CI->session->userdata('matricula');
            if(!$this->CI->session->userdata('matricula')){
                $admin = 0;
                $usuario_matricula = 'site';
            }


            $this->CI->db->insert('auditoria',
                array('acao' => $acao,
                    'usuario_matricula' => $usuario_matricula,
                    'tabela' => $tabela,
                    'data' => mdate('%Y-%m-%d %H:%i:%s'),
                    'conteudo' => $conteudo,
                    'ip' => getenv("REMOTE_ADDR"),
                    'admin' => $admin)
            );
        endif;
    }

    public function moeda($valor,$modelo = "brasil"){

        switch ($modelo) {
            case 'banco':
                $divDec = ".";
                $divMil = "";
                break;
            
            default:
                $divDec = ",";
                $divMil = ".";
                break;
        }

        return number_format($valor,2,$divDec,$divMil);

    }

    public function criptografar($valor){
        $this->CI->load->library('criptografia');
        return $this->CI->criptografia->enc("$valor");
    }

    public function desCriptografar($valor){
        $this->CI->load->library('criptografia');
        return $this->CI->criptografia->dec("$valor");
    }

    public function converteData($data,$divisorAtual="-",$divisorNovo="/"){

        if($data){
            $novaData = explode($divisorAtual,substr($data, 0, 10));
            return $novaData[2].$divisorNovo.$novaData[1].$divisorNovo.$novaData[0];
        }

    }

    public function tratarAutoComplete($valor){

        $retorno = explode(']',$valor);
        return str_replace('[', '', $retorno[0]);

    }

    public function incrementarData($data, $operacao){
        /*  exemplo $operacao 
            "+1 month", "-10 days" */

        //formato da data dd/mm/YY          
        list($dia_parcela, $mes_parcela, $ano_parcela) = explode("/", $data);
        
        // Esta mesma data em formato UNIX timestamp
        $timestamp = mktime(0, 0, 0, $mes_parcela, $dia_parcela, $ano_parcela);

        // Incrementando um mês à esta data
        $nova = strtotime($operacao, $timestamp);

        // Exibindo nova data
        return mdate("%d/%m/%Y", $nova);
    }
    
    public function tratarCharset($string){

        return utf8_decode($string);

    }

    public function msgError($msg){

        exit("<html>
            <script>
                alert('$msg');
                window.close();
            </script>
        </html>");

    }

    public function tab($qtde){
        $retorno = '';

        for($i=0; $i<$qtde; $i++){
            $retorno .= ' ';
        }

        return $retorno;
    }

    public function geraSenha($senha, $login = NULL) {
        if (empty($login)) {
            $salt = '102d10d54sdsdhf4f5f54f50f5s4f4505f';
            $gera_pass = sha1($salt . $senha . 'Gênesis');
        } else {
            $salt = "0c8a1ca3e1316de28f8af408a684284c";
            $gera_pass = md5($login . $salt . $senha);
        }
        
        return $gera_pass;
    }

    public function geraRandonString($n){
        $str = "ABCDEFGHIJLMNOPQRSTUVXZYWKabcdefghjlmnopqrstuvxzywk0123456789_-";
        $cod = "";
        for($a = 0;$a < $n;$a++){
            $rand = rand(0,63);
            $cod .= substr($str,$rand,1);}
        return $cod;
    }

    public function doUpload($nome_campo,$pasta){

        if(!empty($_FILES[$nome_campo]["name"])):
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $_FILES[$nome_campo]["name"], $ext);

            // Gera um nome único para a imagem
            $NaoExiste="";

            while (empty($NaoExiste))
            {
                $nome_imagem ="";
                $nome_imagem = $this->geraRandonString(95).".".$ext[1];

                if (!file_exists(FCPATH."imagens/".$pasta."/".$nome_imagem)) $NaoExiste = 1;
            }

            $config['file_name'] = $nome_imagem;
            $config['upload_path'] = FCPATH.'imagens/'.$pasta.'/';
            $config['allowed_types'] = 'gif|bmp|png|jpg|jpeg';
            $config['max_size'] = '200';
            $config['max_width']  = '2048';
            $config['max_height']  = '1536';

            $this->CI->load->library('upload', $config);

            //if ( !$this->CI->upload->do_upload($nome_campo) ):
            if(!move_uploaded_file($_FILES[$nome_campo]['tmp_name'], $config['upload_path'].$config['file_name'])):

                echo "
                     <div class='alert alert-danger alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                            
                        <h4><strong>Desculpe!</strong></h4>
                        "; /*echo $this->CI->upload->display_errors('<p>', '</p>');*/ echo " 
                        <p>Não foi possível realizar o upload</p>
                    </div>
                ";
                //ocorreu erro no upload
                return -1;
            endif;

            return $nome_imagem;
        else:
            //não tentou fazer upload
            return 0;

        endif;


    }

    public function removerFoto($nome_campo,$tabela,$pasta,$id){
        $nome_campo = trim(addslashes($nome_campo));
        $tabela = trim(addslashes($tabela));
        $id = (int) addslashes($id);

        if($nome_campo and $tabela and $id){
            $sql = "select $nome_campo from $tabela where id = $id";
            $rs = $this->CI->db->query($sql)->row();

            if($rs->{$nome_campo} && file_exists(FCPATH."imagens/$pasta/".$rs->{$nome_campo})) unlink(FCPATH."imagens/$pasta/".$rs->{$nome_campo}); //remove a foto
        }
    }

    public function geraSelect($dados,$msg = ""){

        $dados['condicao'] = (empty($dados['condicao'])) ? " where status = true " : $dados['condicao'];

        $sql = "select ".$dados['primary_key']." as chave_primaria,".$dados['nome']." as descricao from ".$dados['tabela']." ".$dados['condicao']." ";
        $rs = $this->CI->db->query($sql)->result();

        $texto = '
        <select name="'.$dados["nome_input"].'" id="'.$dados["id"].'" class="'.$dados["class"].'" onChange="'.$dados["onchange"].'" '.$dados["disabled"].'>';

        if(is_null($dados['required'])){ 
            $texto .= '<option value="">'.$msg.'</option>';
        }

        foreach ($rs as $key => $registro):

            $texto .= '<option value="'.$registro->chave_primaria.'" ';

            if($dados["value"] === $registro->chave_primaria)
                $texto.= 'selected';

            $texto.='>'.$registro->descricao.'</option>'."\r\n";

        endforeach;


        $texto.='</select>';

        echo $texto;

    }


    public function getMenuCategorias() {
        
        $this->CI->load->model('categoria_model', 'categoria');
        $registros = $this->CI->categoria->getAll('descricao', 'asc')->result();

        $menu = "";

        foreach($registros as $registro){
            $menu .= '<li><a href="'.base_url('detalhe_produto/por_categoria/'.$this->criptografar($registro->id)).'">'.$registro->descricao.'</a></li>';
        }

        return $menu;
    }

}

/* End of file Funcoes_gerais.php */