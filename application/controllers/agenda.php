<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Agenda extends MY_Controller{
		function index(){
                    ################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					$this->seo_pagina(-2);
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
                    $d = getdate(time());
		            $month = $this->input->get("month");
                    $day = $this->input->get("day");
                    $year = $this->input->get("year");
                    $filtro = $this->input->get("filtro");
                    $uf = $this->input->get("uf");
                    if ($month == ""){   $month = $d["mon"]; }
                    if ($year == "") {   $year = $d["year"]; }
                    if ($filtro == "") { $filtro =""; }
                    
                    // BUSCA OBRIGAÇÕES SERVIDOR
                    $obrigacao="";
                    $obrigacoes = new NoticiasRss();
                    $obrigacoes->set_NoticiasRss("http://www.netcontabil.com.br/package_update/cliente_obrigacao_filtro_js.php?ano=$year&mes=$month&filtro=$filtro&uf=$uf");
                    $tags = array("dia","titulo","filtro");
                    while ($c = $obrigacoes->getTag($tags)) {
                                $obrigacao[ $c["dia"] ][] = $c["titulo"];
                    }
                    ksort($obrigacao);
		    $index = -1;
		    $flag=0;
                    $lista_obrigacao_view ="
                    <script>
                            function muda(agenda) {
                            agenda = this.document.getElementById('agendaid').value;
                            this.document.location.href = '".site_url()."/agenda/?filtro='+agenda+'&month=".$this->input->get("month")."';
                            }
                    </script>
                    <b>Filtrar a Agenda Ex: Federal,Estadual,Municipal ...</b> <script type=\"text/javascript\" src=\"http://www.netcontabil.com.br/package_update/agenda_categoria_js.php?filtro=".$this->input->get("filtro")."\"> </script>
                    ";
                    $lista_obrigacao_view.=
                    "<table style=\"width:100%;font-size:13px;padding-left:0px;padding-right:5px;\">
				<tr>
                                    <th colspan=\"2\"><h3>".common::mes_extenso($this->input->get("month"))." de ".$year."</h3></th>
				</tr>
				<tr>
                                    <td style=\"background-color:#666666;color:#ffffff;font-weight:bolder;\">&nbsp;Dia&nbsp;</td><td style=\"background-color:#666666;color:#ffffff;font-weight:bolder;\">&nbsp; Obrigação</td>
				</tr>
                    ";        
		    foreach( $obrigacao as $key => $value ) {
		           foreach( $value as $titulo) {
                                $ancora="";	
				$index++;
				if ( ( $index % 2) == 0 ) $color = "#f2f2f2"; else $color = "#ffffff";
				if ( ((int)$day) == ((int)$key) ){
				      	  if ($flag==0){
                                            $lista_obrigacao_view.= "<tr style=\"background-color:#FFFFFF;\"><td style=\"text-align:center;height:20px; \" colspan='2'><h1><a name='$day' style='color:#DE2421'>Dia $day</a></h1></td></tr>";					                	  	
					  }
					  $flag = 1;
					  $border = "border:solid 1px #DE2421;"; 
					  $ancora = "<a name='$day'></a>";		  
				}else{
					  if (($flag=="1")){
						$lista_obrigacao_view.= "<tr style=\"background-color:#FFFFFF;\"><td style=\"text-align:center;height:20px; \" colspan='2'><a href='#agenda' style='text-decoration:none;color:#DE2421;font-weight:bold'>[ voltar para agenda ]</a></td></tr>";
                                                $flag=0;
					  }
					  $border = "";
				}
				$lista_obrigacao_view.= "<tr style=\"background-color:$color;\"><td style=\"padding-left:8px;$border\">$ancora" . $key . "</td><td style=\"padding-left:8px;$border\">" . $titulo . "</td></tr>";
                            }
                    }
		    $lista_obrigacao_view.= "<tr style=\"background-color:#FFFFFF;\"><td style=\"text-align:center;height:20px; \" colspan='2'><a href='#agenda' style='text-decoration:none;color:#DE2421;font-weight:bold'>[ voltar para agenda ]</a></td></tr>";        
                    $uf="";
                    $lista_obrigacao_view.="</table>";
                    
                    $this->conteudo["agenda_obrigacao_lista"]=$lista_obrigacao_view;
                    
                    $this->load->library('parser');
                    $this->parser->parse('topo_view', $this->conteudo);
                    $this->parser->parse('pagina_agenda_view', $this->conteudo);
                    $this->parser->parse('rodape_view', $this->conteudo);
		}
	}


?>