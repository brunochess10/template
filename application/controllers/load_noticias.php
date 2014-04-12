<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Load_noticias extends CI_Controller {
    
    function index(){
		$this->load->library('parser');
		$data["noticias"] = $this->read_noticias(5);
		$this->parser->parse("noticias_view",$data);
	}
    
	function read_noticias($num_noticias) {
        $httprequest_noticia = new httprequest_();
        $httprequest_noticia->set_httprequest_("http://www.netcontabil.com.br/package_update/conteudo/noticias.xml");
        $xml_string = $httprequest_noticia->DownloadToString();
        $xml = new SimpleXMLElement($xml_string);
		
        for ($i = 0; $i < $num_noticias; $i++) {
            $noticia[$i]["titulo"] = $xml->channel->item[$i]->title;
            $noticia[$i]["link"] = $xml->channel->item[$i]->link;
        }
        return $noticia;
    }

}

?>
