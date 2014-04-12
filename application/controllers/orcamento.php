<?php

class Orcamento extends MY_Controller{
		function index(){
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					$this->seo_pagina(-10);
					################################################################################
					#  Seta o ID do SEO da Página
					################################################################################
					$this->load->library('parser');
                    $this->parser->parse('topo_view', $this->conteudo);
                    
                    //carregar o helper do formulario
                    //carregar o helper do para consistência
                    //$this->load->helper(array('form', 'url'));
                    $this->load->library('form_validation');
                    $this->form_validation->set_message('required', '*Preencha o campo %s');
                    
                    $this->form_validation->set_rules('Empresa', 'Empresa', 'required|min_length[1]');
                    $this->form_validation->set_rules('Endereco', 'Endereço', 'required|min_length[1]');
					$this->form_validation->set_rules('Numero', 'Número', 'required|min_length[1]');
					$this->form_validation->set_rules('Bairro', 'Bairro', 'required|min_length[1]');
					$this->form_validation->set_rules('Cidade', 'Cidade', 'required|min_length[1]');
					$this->form_validation->set_rules('Estado', 'Estado', 'required|min_length[1]');
					
					$this->form_validation->set_rules('cep', 'CEP', 'required|min_length[1]');
					$this->form_validation->set_rules('Nome_contato', 'Nome do Contato', 'required|min_length[2]');
					$this->form_validation->set_rules('ddd_contato', 'DDD Contato', 'required|min_length[2]');
					$this->form_validation->set_rules('Telefone_contato', 'Telefone Contato', 'required|min_length[8]');
					$this->form_validation->set_rules('Email_contato', 'E-mail', 'required|valid_email');
                   
                    
                    
                    
                    if ($this->form_validation->run() == FALSE)
                    {
                      $this->parser->parse('pagina_orcamento_view',$this->conteudo);
                    }
                    else
                    {
                        //eniviar o e-mail

                        /*$this->email->from($this->conteudo["email"],$this->conteudo["titulo_site"]);
                        $this->email->to($this->conteudo["email"]);
                        $this->email->subject('Email enviado pelo fale conosco do web site');*/
						
						
                        //monta a mensagem que vai para o e-mail de contato da empresa
                        $message = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
						<html xmlns=\"http://www.w3.org/1999/xhtml\">
						<head>
						<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />
						<title>Email enviado pelo site</title>
						<style>
						table{
							margin:auto;
							width:650px;
							border-collapse:collapse;
							}
						table,th,td{border:solid 1px #CCC;padding:5px;font-size:12px;font-family:Arial, Helvetica, sans-serif;color:#333;}
						thead th{background-color:#f2f2f2;}
						tfoot th{background-color:#f2f2f2;text-align:left;vertical-align:top;}
						tbody th{background-color:#f2f2f2;text-align:left;}
						
						</style>
						
						</head>
						
						<body>
						
						<table>
						<thead>
						<tr>
										<th colspan=\"2\">
							Email enviado pela página de orçamento do web site
						</th>
										</tr>    
						</thead>
						<tbody>
										<tr>
											<th>Empresa</th><td>".$this->input->post("Empresa")."</td>
										</tr>
										<tr>
											<th>Endereço</th><td>".$this->input->post("Endereco")."</td>
										</tr>
										<tr>
											<th>Número</th><td>".$this->input->post("Numero")."</td>
										</tr>
										<tr>
											<th>Bairro</th><td>".$this->input->post("Bairro")."</td>
										</tr>
										<tr>
											<th>cep</th><td>".$this->input->post("cep")."</td>
										</tr>
										<tr>
											<th>Nome contato</th><td>".$this->input->post("Nome_contato")."</td>
										</tr>
										<tr>
											<th>E-mail contato</th><td>".$this->input->post("Email_contato")."</td>
										</tr>
										<tr>
											<th>Ramo Atividade</th><td>".$this->input->post("ramo_atividade_industria")."</td>
										</tr>
										<tr>
											<th>Ramo Atividade</th><td>".$this->input->post("ramo_atividade_associacao")."</td>
										</tr>
										<tr>
											<th>Ramo Atividade</th><td>".$this->input->post("ramo_atividade_outros")."</td>
										</tr>
										<tr>
											<th>Constituição</th><td>".$this->input->post("Constituicao")."</td>
										</tr>
										<tr>
											<th>Tributação</th><td>".$this->input->post("Tributacao")."</td>
										</tr>
										<tr>
											<th>Número de Funcionários</th><td>".$this->input->post("Numero_Funcionarios")."</td>
										</tr>
										<tr>
											<th>Número de Estagiários</th><td>".$this->input->post("Numero_Estagiarios")."</td>
										</tr>
										<tr>
											<th>Sócios pessoa jurídica nacional</th><td>".$this->input->post("Socios_pessoa_Juridica_Nacional")."</td>
										</tr>
										<tr>
											<th>Sócios pessoa jurídica internacional</th><td>".$this->input->post("Socios_Pessoa_Juridica_Internacional")."</td>
										</tr>
										<tr>
											<th>Sócios pessoa física brasileira</th><td>".$this->input->post("Socios_Pessoa_fisica_Brasileira")."</td>
										</tr>
										<tr>
											<th>Sócios pessoa física estrangeira</th><td>".$this->input->post("Socios_Pessoa_Fisica_Estrangeira")."</td>
										</tr>
										<tr>
											<th>Bancos em que tem conta</th><td>".$this->input->post("Bancos_em_que_tem_conta")."</td>
										</tr>
										<tr>
											<th>Cheques emitidos por mês</th><td>".$this->input->post("Cheques_emitidos_por_mes")."</td>
										</tr>
										<tr>
											<th>Notas fiscais de venda emitidas por mês</th><td>".$this->input->post("Notas_fiscais_de_Venda_emitidas_por_mes")."</td>
										</tr>
										<tr>
											<th>Notas fiscais de serviço emitidas por mês</th><td>".$this->input->post("Notas_fiscais_de_Serviço_emitidas_por_mes")."</td>
										</tr>
										<tr>
											<th>Importações efetuadas por mês</th><td>".$this->input->post("Importacoes_efetuadas_por_mes")."</td>
										</tr>
										<tr>
											<th>Observações</th><td>".$this->input->post("Observacao")."</td>
										</tr>
										
										
										</tbody>
										</table>
										</body>
										</html>
						";
                        
						$mail = new htmlMimeMail();
						$this->set_params_smtp($mail);
						$mail->setHtml($message, $message);
						$mail->setReturnPath($this->smtp["EMAIL_FROM"]);
						$mail->setFrom("\"" . $this->conteudo["titulo_site"] . "\"  <" .  $this->smtp["EMAIL_FROM"] . ">" );
						$mail->setSubject("Pedido de Orçamento enviado pelo web site da ACL");
						$mail->setHeader("X-Mailer", "Newsletter - Powered by NeoSolutions (http://www.neosolutions.com.br)");
						$email[0]=$this->smtp["EMAIL_FROM"];
						$result = $mail->send($email, $this->smtp["EMAIL_METHOD"] );
						
						//print_r($mail);						
                        
						if ($result){
                            $this->load->view('pagina_orcamento_sucesso_view');
                        }else{
                            $this->load->view('pagina_orcamento_erro_view');
                        }
                    }
                    
                    $this->parser->parse('rodape_view', $this->conteudo);
		
                }
        }
		
	
?>
