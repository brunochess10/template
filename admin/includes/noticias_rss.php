<?php
/**
* Esta classe é a responsável por ler Noticias Rss.
* @author WebÚnica Informática LTDA <contato@webunica.com.br>
* @version 1.7
* @copyright Copyright © 2005, WebÚnica Informática LTDA.
* @access public
* @package NoticiasRss
* <code>
* Exemplo:
* <?php
* require_once("NoticiasRss.php");
* $noticiasINFO = new NoticiasRss("http://info.abril.com.br/aberto/infonews/rssnews.xml");
* $tags = array("link","title","description");
* while ($c = $noticiasINFO->getTag($tags)){
* 	echo"<p>
* 		<a href=\"".$c['link']."\">
* 			<b>".$c['title']."</b></a>
* 			<br>
* 			<i>".$c['description']."</i>
* 		</p>";
* }
* ?>
* </code>
* @see exemplo.php
*/

class HTTPRequest_
{
   var $_fp;        // HTTP socket
   var $_url;        // full URL
   var $_host;        // HTTP host
   var $_protocol;    // protocol (HTTP/HTTPS)
   var $_uri;        // request URI
   var $_port;        // port
  
   // scan url
   function _scan_url()
   {
       $req = $this->_url;
      
       $pos = strpos($req, '://');
       $this->_protocol = strtolower(substr($req, 0, $pos));
      
       $req = substr($req, $pos+3);
       $pos = strpos($req, '/');
       if($pos === false)
           $pos = strlen($req);
       $host = substr($req, 0, $pos);
      
       if(strpos($host, ':') !== false)
       {
           list($this->_host, $this->_port) = explode(':', $host);
       }
       else
       {
           $this->_host = $host;
           $this->_port = ($this->_protocol == 'https') ? 443 : 80;
       }
      
       $this->_uri = substr($req, $pos);
       if($this->_uri == '')
           $this->_uri = '/';
   }
  
   // constructor
   function HTTPRequest_($url)
   {
       $this->_url = $url;
       $this->_scan_url();
   }
  
   // download URL to string
   function DownloadToString()
   {
       $crlf = "\r\n";
      
       // generate request
       $req = 'GET ' . $this->_uri . ' HTTP/1.0' . $crlf
           .    'Host: ' . $this->_host . $crlf
           .    $crlf;
      
       // fetch
       $this->_fp = fsockopen(($this->_protocol == 'https' ? 'ssl://' : '') . $this->_host, $this->_port);
       fwrite($this->_fp, $req);
       while(is_resource($this->_fp) && $this->_fp && !feof($this->_fp))
           $response .= fread($this->_fp, 1024);
       fclose($this->_fp);
      
       // split header and body
       $pos = strpos($response, $crlf . $crlf);
       if($pos === false)
           return($response);
       $header = substr($response, 0, $pos);
       $body = substr($response, $pos + 2 * strlen($crlf));
      
       // parse headers
       $headers = array();
       $lines = explode($crlf, $header);
       foreach($lines as $line)
           if(($pos = strpos($line, ':')) !== false)
               $headers[strtolower(trim(substr($line, 0, $pos)))] = trim(substr($line, $pos+1));
      
       // redirection?
       if(isset($headers['location']))
       {
           $http = new HTTPRequest_($headers['location']);
           return($http->DownloadToString($http));
       }
       else
       {
           return($body);
       }
   }
}

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
	function NoticiasRss($endereco){
		$this->endereco = $endereco;
		$r = new HTTPRequest_($this->endereco);
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

//Classe que lê XML chama-se XML2ARRAY

//classe xml2array para ler o XML 
//classe xml2array para ler o XML 
//classe xml2array para ler o XML 
//classe xml2array para ler o XML 


/** 
 * Exemplos de como usar a classe
 * xml2array() will convert the given XML text to an array in the XML structure. 
 * Link: http://www.bin-co.com/php/scripts/xml2array/ 
 * Arguments : $contents - The XML text 
 * $get_attributes - 1 or 0. If this is 1 the function will get the attributes as well as the tag values - this results in a different array structure in the return value. 
 * $priority - Can be 'tag' or 'attribute'. This will change the way the resulting array sturcture. For 'tag', the tags are given more importance. 
 * Return: The parsed XML in an array form. Use print_r() to see the resulting array structure. 
 * Examples: $array =  xml2array(file_get_contents('feed.xml')); 
 * $array =  xml2array(file_get_contents('feed.xml', 1, 'attribute')); 
 */ 
function xml2array($contents, $get_attributes=1, $priority = 'tag') { 
    if(!$contents) return array(); 

    if(!function_exists('xml_parser_create')) { 
        //print "'xml_parser_create()' function not found!"; 
        return array(); 
    } 

    //Get the XML parser of PHP - PHP must have this module for the parser to work 
    $parser = xml_parser_create(''); 
    xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8"); # http://minutillo.com/steve/weblog/2004/6/17/php-xml-and-character-encodings-a-tale-of-sadness-rage-and-data-loss 
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0); 
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1); 
    xml_parse_into_struct($parser, trim($contents), $xml_values); 
    xml_parser_free($parser); 

    if(!$xml_values) return;//Hmm... 

    //Initializations 
    $xml_array = array(); 
    $parents = array(); 
    $opened_tags = array(); 
    $arr = array(); 

    $current = &$xml_array; //Refference 

    //Go through the tags. 
    $repeated_tag_index = array();//Multiple tags with same name will be turned into an array 
    foreach($xml_values as $data) { 
        unset($attributes,$value);//Remove existing values, or there will be trouble 

        //This command will extract these variables into the foreach scope 
        // tag(string), type(string), level(int), attributes(array). 
        extract($data);//We could use the array by itself, but this cooler. 

        $result = array(); 
        $attributes_data = array(); 
         
        if(isset($value)) { 
            if($priority == 'tag') $result = $value; 
            else $result['value'] = $value; //Put the value in a assoc array if we are in the 'Attribute' mode 
        } 

        //Set the attributes too. 
        if(isset($attributes) and $get_attributes) { 
            foreach($attributes as $attr => $val) { 
                if($priority == 'tag') $attributes_data[$attr] = $val; 
                else $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr' 
            } 
        } 

        //See tag status and do the needed. 
        if($type == "open") {//The starting of the tag '<tag>' 
            $parent[$level-1] = &$current; 
            if(!is_array($current) or (!in_array($tag, array_keys($current)))) { //Insert New tag 
                $current[$tag] = $result; 
                if($attributes_data) $current[$tag. '_attr'] = $attributes_data; 
                $repeated_tag_index[$tag.'_'.$level] = 1; 

                $current = &$current[$tag]; 

            } else { //There was another element with the same tag name 

                if(isset($current[$tag][0])) {//If there is a 0th element it is already an array 
                    $current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result; 
                    $repeated_tag_index[$tag.'_'.$level]++; 
                } else {//This section will make the value an array if multiple tags with the same name appear together 
                    $current[$tag] = array($current[$tag],$result);//This will combine the existing item and the new item together to make an array 
                    $repeated_tag_index[$tag.'_'.$level] = 2; 
                     
                    if(isset($current[$tag.'_attr'])) { //The attribute of the last(0th) tag must be moved as well 
                        $current[$tag]['0_attr'] = $current[$tag.'_attr']; 
                        unset($current[$tag.'_attr']); 
                    } 

                } 
                $last_item_index = $repeated_tag_index[$tag.'_'.$level]-1; 
                $current = &$current[$tag][$last_item_index]; 
            } 

        } elseif($type == "complete") { //Tags that ends in 1 line '<tag />' 
            //See if the key is already taken. 
            if(!isset($current[$tag])) { //New Key 
                $current[$tag] = $result; 
                $repeated_tag_index[$tag.'_'.$level] = 1; 
                if($priority == 'tag' and $attributes_data) $current[$tag. '_attr'] = $attributes_data; 

            } else { //If taken, put all things inside a list(array) 
                if(isset($current[$tag][0]) and is_array($current[$tag])) {//If it is already an array... 

                    // ...push the new element into that array. 
                    $current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result; 
                     
                    if($priority == 'tag' and $get_attributes and $attributes_data) { 
                        $current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data; 
                    } 
                    $repeated_tag_index[$tag.'_'.$level]++; 

                } else { //If it is not an array... 
                    $current[$tag] = array($current[$tag],$result); //...Make it an array using using the existing value and the new value 
                    $repeated_tag_index[$tag.'_'.$level] = 1; 
                    if($priority == 'tag' and $get_attributes) { 
                        if(isset($current[$tag.'_attr'])) { //The attribute of the last(0th) tag must be moved as well 
                             
                            $current[$tag]['0_attr'] = $current[$tag.'_attr']; 
                            unset($current[$tag.'_attr']); 
                        } 
                         
                        if($attributes_data) { 
                            $current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data; 
                        } 
                    } 
                    $repeated_tag_index[$tag.'_'.$level]++; //0 and 1 index is already taken 
                } 
            } 

        } elseif($type == 'close') { //End of tag '</tag>' 
            $current = &$parent[$level-1]; 
        } 
    } 
     
    return($xml_array); 
}  

?>
