<?php //if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Boletim extends MY_Controller{
		function index(){
					
					
                    ################################################################################
                    #  carrega as páginas no nosso layout e também passa os dados para as mesmas
                    ################################################################################
                    //$this->load->library('parser');
                    //$this->parser->parse('topo_view', $this->conteudo);
                    //$this->parser->parse('pagina_boletim_view', $this->conteudo);
                    //$this->parser->parse('rodape_view', $this->conteudo);
                }
                
                function texto($id){
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					$this->seo_pagina(-4);
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
				
                    ####################################
                    # Carrega o Model
                    ####################################
                    $this->load->model("Mail_model");
                    $boletim = $this->Mail_model->get_one_boletim($id);
                    $this->conteudo["titulo_boletim"] = $boletim[0]->mail_assunto;
                    $this->conteudo["texto_boletim"] = htmlspecialchars_decode($boletim[0]->mail_corpo);
                    $this->conteudo["mail_id"] = $id; 
                    #teste
			
                    //echo Common::sanitize_title_with_dashes($boletim[0]->mail_assunto);
                    			
                    ################################################################################
                    #  carrega as páginas no nosso layout e também passa os dados para as mesmas
                    ################################################################################
                    
                    ################################################################################
                    #  Carrega comentários do Facebook
                    ################################################################################
                    
                    $url = "/boletim/texto/".$id;
                    $this->conteudo["facebook_comentario"] = Facebook::Facebook_comentario($url);
                    
                    $this->load->library('parser');
                    $this->parser->parse('topo_view', $this->conteudo);
                    $this->parser->parse('pagina_boletim_view', $this->conteudo);
                    $this->parser->parse('rodape_view', $this->conteudo);
                }
                
          function lista(){
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					$this->seo_pagina(-4);
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					
          ################################################################################
          #  carrega as páginas no nosso layout e também passa os dados para as mesmas
          ################################################################################
					
					$palavra_chave = $this->input->post('pesquisa');
					
					
					if ($palavra_chave==""){
						$palavra_chave = $this->input->get('pesquisa');
					}
					
          $this->load->model("Mail_model");
					$page = $this->input->get('per_page');
					
					$quantidade_pagina = 10;
                    $aux_boletim =  $this->Mail_model->get_all_boletins($quantidade_pagina,$page,$palavra_chave);
					
					          
					          //echo "<pre>";
                    //print_r($aux_boletim);
                    //echo "</pre>";
                    
                    $lista_boletim = "";
                    $data_anterior= "";
                    $w=-1;
                    
                    for ($i=0;$i<count($aux_boletim);$i++){
                        $data_aux = common::data_brasil($aux_boletim[$i]->mail_data);
                        $data_aux = explode("/",$data_aux);
                        $data_aux_mes_ano = $data_aux[1]."/".$data_aux[2];
                        if ($data_aux_mes_ano!=$data_anterior){
                            $w++;
                            $lista_boletim[$w]['mes']=$data_aux_mes_ano;
                            $data_anterior=$data_aux_mes_ano;
                            $lista_boletim[$w]['assuntos']="";
                        }
						$pos = strpos(site_url(),"index.php");
						if ($pos){
							$barra_windows = "/";
						}else{
							$barra_windows = "";
						}
                        $lista_boletim[$w]['assuntos'].="<li><a href=\"".site_url().$barra_windows."boletim/texto/".$aux_boletim[$i]->mail_id."/".sanitize_title_with_dashes($aux_boletim[$i]->mail_assunto)."\">".common::data_brasil($aux_boletim[$i]->mail_data)." - ".$aux_boletim[$i]->mail_assunto."</a></li>";
                        unset($data_aux);
                    }
                    
                    $this->conteudo["lista_boletim"] = $lista_boletim;
                    
                    if  (count($aux_boletim)==0){
                         $this->conteudo['mes']="";
                         $this->conteudo['assuntos']="";
                         $this->conteudo['lista_boletim']="";
                         $this->conteudo['/lista_boletim']="";
                    }
                    
					//print_r($this->conteudo["lista_boletim"]);
                    $this->load->library('pagination');
					
					$config['page_query_string'] = true;
					if ($palavra_chave==""){
						$config['total_rows'] = $this->db->count_all("mail");
					}else{
						$config['total_rows'] = count($this->Mail_model->get_total($palavra_chave));
					}
					$config['per_page'] = $quantidade_pagina;
					$config['first_link'] = 'Primeira Página';
					$config['last_link'] = 'Última Página';
					$config['num_links'] = 5;
					
					$config['base_url'] = site_url()."/boletim/lista/?lista=$quantidade_pagina&pesquisa=$palavra_chave";
					$this->pagination->initialize($config);
					$this->conteudo["paginacao"] = $this->pagination->create_links();
					
					$this->load->library('parser');
                    $this->parser->parse('topo_view', $this->conteudo);
                    $this->parser->parse('pagina_boletim_lista_view', $this->conteudo);
					$this->parser->parse('rodape_view', $this->conteudo);
                }
				
				function remove_email(){
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					$this->seo_pagina(-4);
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					
					$email = $this->input->post('email_descadastro');
					
					####################################
          # Carrega o Model
          ####################################
					$this->load->model("Descadastro_model");
					$descadastro_resultado = $this->Descadastro_model->verificar_se_email_existe($email);
					
					if ($descadastro_resultado > 0){
						$this->conteudo["mensagem_descadastro"]= "O seu e-mail saiu da nossa base de dados, obrigado !";
					}else{
						$this->conteudo["mensagem_descadastro"]= "O seu e-mail não está na nossa base de dados !";
					}
					$this->Descadastro_model->descadastro_boletim($email);
					
					$this->load->library('parser');
          $this->parser->parse('topo_view', $this->conteudo);
          $this->parser->parse('pagina_descadastro_boletim_view', $this->conteudo);
					$this->parser->parse('rodape_view', $this->conteudo);
				}
}

?>