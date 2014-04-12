<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Noticiasrss
 *
 * @author Bruno
 */
class NoticiasRss{
	/**
    * Variável que recebe o endereço das Noticias Rss.
    * @access public
    * @name $endereco
    */
    var $endereco;

    /**
    * Variável que recebe o aquivo das Noticias Rss.
    * @access public
    * @name $xml
    */
    var $xml;

    /**
    * Variável do indice da Noticias Rss.
    * @access public
    * @name $indice
    */
	var $indice = 0;



    /**
    * Função construtora para manipular NoticasRSS.
    * @access public
    * @param String[] $endereco Endereço da Noticia Rss.
    * @return void
    */
	function set_NoticiasRss($endereco){
		$this->endereco = $endereco;
		$r = new httprequest_();
                $r->set_httprequest_($this->endereco);
		$this->xml = $r->DownloadToString();
	}
        
        

	function unhtmlentities ($string){
            $trans_tbl = get_html_translation_table (HTML_ENTITIES);
            $trans_tbl = array_flip ($trans_tbl);
            return strtr ($string, $trans_tbl);
	}


	/**
    * Função para obter os dados da tag.
    * @access public
    * @param Array[] $tag O nome das tags que deseja obter os dados.
    * @return Array[] Os dados do nome da tag
    */
	function getTag($tag){
		if ($this->indice >= $this->getQuantidade()){
			return null;
		}elseif (!$this->xml){
			return null;
		}else{
			for ($i = 0; $i<count($tag); $i++){
				$preg = "|<$tag[$i]>(.*?)</$tag[$i]>|s";
				preg_match_all($preg, $this->xml, $tags);
				$c = 1;
				foreach ($tags[1] as $tmpcont){
					if ($c == $this->indice){
						break;
					}else{
						$c++;
					}
				}
				$tmpcont2[$tag[$i]] = $tmpcont;
				$tmpcont2[$tag[$i]] = str_replace("<!\[CDATA\[","",$tmpcont2[$tag[$i]]);
				$tmpcont2[$tag[$i]] = str_replace("]]>","",$tmpcont2[$tag[$i]]);
				//limpa tags html
				$tmpcont2[$tag[$i]] = strip_tags( $this->unhtmlentities($tmpcont2[$tag[$i]]) );
			}
			$this->indice++;
			return $tmpcont2;
		}
	}

	/**
    * Função para descobrir a quantidade de noticias foram encontrado.
    * @access public
    * @return Int[] A quantida de Noticias Rss
    */
	function getQuantidade(){
		$preg = "|<item>(.*?)</item>|s";
		preg_match_all($preg, $this->xml, $tags);
		$quantidade = 0;
		foreach ($tags[1] as $tmpcont){
			$quantidade++;
		}
		return $quantidade;
	}

	/**
    * Função que retorna o endereco da Noticia Rss.
    * @access public
    * @return String[] O endereco do objeto.
    */
	function getEndereco(){
		return $this->endereco;
	}

	/**
    * Função que retorna o aquivo das Noticias Rss.
    * @access public
    * @return string[] O aquivo das Noticias Rss
    */
	function getXml(){
		return $this->xml;
	}

	/**
    * Função que retorna o indice das Noticias Rss.
    * @access public
    * @return Int[] O indice das Noticias Rss
    */
	function getIndice(){
		return $this->indice;
	}

	/**
    * Função que seta o indice das Noticias Rss.
    * @param int[] $indice O numero do indice das Noticias Rss.
    * @access public
    */
	function setIndice($indice){
		$this->indice = $indice;
	}

	/**
    * Função que reseta o indice das Noticias Rss.
    * @access public
    */
	function resetIndice(){
		$this->indice = 0;
	}

}

?>
