<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Load_agenda extends CI_Controller {
    
    function index(){
       $month="";
       $year="";
       $mun="";
       $uf="";
       
       $month = $this->input->get('month');
       $year = $this->input->get('year');
       $mun =$this->input->get('mun');
       $uf =$this->input->get('uf');
	   $path_calendar = $this->input->get('path_calendar'); 	
       
       $data["agenda"] = $this->carrega_agenda($month, $year, $mun, $uf, $path_calendar);
       $this->load->view("agenda_view",$data);
    }
    

    function carrega_agenda($month, $year, $mun, $uf, $path_calendar) {

        $d = getdate(time());
        if ($month == "") {
            $month = $d["mon"];
        }
        if ($year == "") {
            $year = $d["year"];
        }

        // BUSCA OBRIGAÇÕES SERVIDOR
        $obrigacoes = new NoticiasRss();
        $obrigacoes->set_NoticiasRss("http://www.netcontabil.com.br/package_update/cliente_obrigacao_js.php?ano=$year&mes=$month&uf=$uf&mun=$mun");
        $tags = array("dia", "titulo");
        while ($c = $obrigacoes->getTag($tags)) {
            $d[] = $c["dia"];
        }
        
        //daqui para baixo nós vamos mostrar o calendário   
        //daqui para baixo nós vamos mostrar o calendário
        $pos = strpos(site_url(),"index.php");
        if ($pos){
			$monta_url_windows = explode("index.php",site_url());
            $pagina_exibicao = $monta_url_windows[0]."index.php/";
        }else{
            $pagina_exibicao = site_url().$path_calendar;
        }
        //echo $pagina_exibicao;
		//$pagina_exibicao = str_replace("index.php//","index.php",$pagina_exibicao);
        $cal = new MyCalendar();
        $cal->set_MyCalendar($d, $filtro="", $uf, $pagina_exibicao);
        //pagina de exibicao
        return $cal->getMonthView($month, $year);
    }
}

?>
