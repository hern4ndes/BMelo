<?php
/**
 * MyCripty - classe para criptografar e reverter a criptografia de forma fácil, simples e segura utilizando PHP.
 *
 * @author Hudolf Jorge Hess
 * @version 1.0b
 * @link www.hudolfhess.com
 */

class Criptografia {

    /**
     * @var int
     */
    public $chave = 97;

    /**
     * @var string
     */
    public $chave_crypto = 'c8I6KOAllXwCL9jfJOfeQ1AqoJComCyCw3EPZ0Xkcy39IFX6k_p1S3PGrcZlOUnd0Y6tAKnThz_t3r0Cc5VxxjcXc-s9kB9Jf';

    public $add_text = '';

    public function __construct(){

        $this->add_text = md5(sha1($this->chave_crypto));

    }

    /**
     * @param string Palavra
     * @return string
     */
    function enc($word){
        $word .= $this->add_text;
        $s = strlen($word)+1;
        $nw = "";
        $n = $this->chave;
        for ($x = 1; $x < $s; $x++){
            $m = $x*$n;
            if ($m > $s){
                $nindex = $m % $s;
            }
            else if ($m < $s){
                $nindex = $m;
            }
            if ($m % $s == 0){
                $nindex = $x;
            }
            $nw = $nw.$word[$nindex-1];
        }
        return $nw;
    }

    /**
     * @param string Palavra
     * @return string
     */
    function dec($word){
        $s = strlen($word)+1;
        $nw = "";
        $n = $this->chave;
        for ($y = 1; $y < $s; $y++){
            $m = $y*$n;
            if ($m % $s == 1){
                $n = $y;
                break;
            }
        }
        for ($x = 1; $x < $s; $x++){
            $m = $x*$n;
            if ($m > $s){
                $nindex = $m % $s;
            }
            else if ($m < $s){
                $nindex = $m;
            }
            if ($m % $s == 0){
                $nindex = $x;
            }
            $nw = $nw.$word[$nindex-1];
        }
        $t = strlen($nw) - strlen($this->add_text);
        return substr($nw, 0, $t);
    }

}


?>