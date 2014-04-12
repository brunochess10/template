<?php

class Consultas extends MY_Controller{
		function index(){
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					$this->seo_pagina(-7);
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
		
                    ################################################################################
                    #  carrega as páginas no nosso layout e também passa os dados para as mesmas
                    ################################################################################
                    
                    $this->conteudo["conteudo_consulta"] ="
                         <script type=\"text/javascript\" src=\"http://www.netcontabil.com.br/package_update/conteudo/conteudo_contabil.php?content=consultas&uf=".$this->conteudo["estado"]."\"></script>
                    ";
                    
                    $this->load->library('parser');
                    $this->parser->parse('topo_view', $this->conteudo);
                    $this->parser->parse('pagina_consulta_view', $this->conteudo);
                    $this->parser->parse('rodape_view', $this->conteudo);
                }
             
        }
?>