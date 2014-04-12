<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Load_compara extends CI_Controller {
    
    function index(){
		$this->load->library('parser');
		$data["resultado"] = $this->calculo_clt_pj($this->input->post('optante_simples'),$this->input->post('remuneracao'),$this->input->post('aliq_iss'),$this->input->post('aliq_simples'));
		$this->parser->parse("compara_view",$data);
	}
    
	function calculo_clt_pj($optante_simples,$remuneracao,$aliq_iss,$aliq_simples) {
        $httprequest_noticia = new httprequest_();
        $httprequest_noticia->set_httprequest_("http://www.netcontabil.com.br/comparacao/compara_process.php?optante_simples=$optante_simples&remuneracao=$remuneracao&aliq_iss=$aliq_iss&aliq_simples=$aliq_simples");
        $resultado = $httprequest_noticia->DownloadToString();
        return $resultado;
    }

}

?>