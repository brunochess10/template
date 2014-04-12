<?php

class Tabelas extends MY_Controller{
		function index(){
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					$this->seo_pagina(-6);
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					
					
                    ################################################################################
                    #  carrega as páginas no nosso layout e também passa os dados para as mesmas
                    ################################################################################
                    
                    $this->conteudo["conteudo_tabelas"] ="
                         <script type=\"text/javascript\" src=\"http://www.netcontabil.com.br/package_update/conteudo/cliente_lista_tabela.php\"></script>
                         <script>
                          $(document).ready(function(){
                            var conteudo = $(\"#conteudo_tabela\").html().replace(/tabela_consulta.php\?tabela=/g,\"tabela/\");
                            $(\"#conteudo_tabela\").html(conteudo);
                          })
                         </script>   
                    ";
                    
                    $this->load->library('parser');
                    $this->parser->parse('topo_view', $this->conteudo);
                    $this->parser->parse('pagina_tabelas_view', $this->conteudo);
                    $this->parser->parse('rodape_view', $this->conteudo);
                }
                
                function tabela($indice_tabela){
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					$this->seo_pagina(-6);
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
				
                    $this->conteudo["conteudo_tabelas"] ="<script type=\"text/javascript\" src=\"".$this->package_update."/cliente_tabela_js.php?tabela=$indice_tabela\"></script>";
                    /*$this->conteudo["conteudo_tabelas"].="
                      <script>
                          $(document).ready(function(){
                            var conteudo = $(\"#conteudo_tabela\").html().replace(/250px/g,\"auto\");
                            $(\"#conteudo_tabela\").html(conteudo);
                          })
                     </script>  
                    ";*/
                    
                    $this->load->library('parser');
                    $this->parser->parse('topo_view', $this->conteudo);
                    $this->parser->parse('pagina_tabelas_view', $this->conteudo);
                    $this->parser->parse('rodape_view', $this->conteudo);
                }
                
                
             
        }
?>
