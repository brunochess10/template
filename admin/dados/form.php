<?php
#
# Params exemplo
# 0 o index, ou seja para o proximo campo coloque 1 e assim sucessivamente
# $params[0]["name"]  =  preencha com o nome do campo
# $params[0]["size"] = preencha com o tamanho do campo caso não queira aderir ao default calculado
# $params[0]["caption"] = preencha com o caption que vc quer que o ccampo apareça o default o name do campo
# $params[0]["type"] = preencha com o tipo do campo
//tipos de campos
//$date = "TIMESTAMP";
//$currency = "DOUBLE";
//$integer = "LONG";
//$cep = "CEP";
//$select = "SELECT";
//$memo = "MEMO";
//$hidden = "HIDDEN";
# $params[0]["help"] = "ditige somente números." // prenche com o help q vc desejar
//--------------------------------------------------------
//SOURCE
//--------------------------------------------------------
    	
		$real_fields ="E.id, E.titulo_site, " .
					           "E.nome_fantasia, E.logradouro, E.numero, E.complemento, E.cidade, E.estado, E.bairro, ". 
							   "E.cep, E.ddd, E.telefone_1, E.telefone_2, E.telefone_3, E.telefone_4, E.fax, E.horario_funcionamento, E.endereco_netcontabil, E.chave_exportacao, E.endereco_seguro, E.topo_boletim, E.cor_boletim, E.logotipo, E.pqec, E.pqec_iso, E.css_cor,
							   E.visualizar_agenda, E.visualizar_cotacao, E.visualizar_indices, E.visualizar_noticias, E.visualizar_boletins,
							   E.visualizar_pagina_ferramentas, E.visualizar_pagina_ferramentas_indices, E.visualizar_pagina_ferramentas_consultas,
							   E.visualizar_pagina_ferramentas_tabelas, E.visualizar_pagina_ferramentas_certidoes, E.visualizar_pagina_ferramentas_guias,
							   E.visualizar_pagina_boletins, E.visualizar_pagina_institucional, E.visualizar_pagina_institucional_empresa, E.visualizar_pagina_institucional_servicos, E.visualizar_pagina_galeria_fotos,E.visualizar_pagina_comparacao, E.codigo_coluna, E.codigo_rodape,
							   E.personalizado, E.certificados, E.css_boletim, E.css_boletim_rodape	
							  ";

		if  ($mode == "edit" || $mode == "detail" ){
			$key = request("key");
			$sql = "select $real_fields from site_dados E where E.". $modules["dados"]["edit_key"] . "='$key' LIMIT 0,1";
		} else if ( $mode == "insert") {
			$sql = "select  $real_fields from site_dados E limit 0,1";
		}
		$EMPRESA = new QUERY($DATABASE,$sql);	                
		$EMPRESA->NEXT();
		
		$index = -1;
		$params_item = array();
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "id";
		$params_item[$index]["caption"] = "Código do item";
		$params_item[$index]["type"] = "HIDDEN";
		$params_item[$index]["disabled"] = true;
		
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "titulo_site";
		$params_item[$index]["caption"] = "Título do Site";
		$params_item[$index]["size"] = "50";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "nome_fantasia";
		$params_item[$index]["caption"] = "Nome da empresa";
		$params_item[$index]["size"] = "50";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "logradouro";
		$params_item[$index]["caption"] = "Rua ou logradouro";
		$params_item[$index]["size"] = "60";		
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "complemento";
		$params_item[$index]["caption"] = "Complemento";
		$params_item[$index]["size"] = "60";		
				
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "numero";
		$params_item[$index]["caption"] = "Número";
		$params_item[$index]["size"] = "10";		
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "cep";
		$params_item[$index]["caption"] = "CEP";
		$params_item[$index]["size"] = "10";		
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "cidade";
		$params_item[$index]["caption"] = "Cidade";
		$params_item[$index]["size"] = "40";		

		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "bairro";
		$params_item[$index]["caption"] = "Bairro";
		$params_item[$index]["size"] = "40";
				
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "estado";
		$params_item[$index]["caption"] = "Estado";
		$params_item[$index]["size"] = "2";				
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "ddd";
		$params_item[$index]["caption"] = "DDD";
		$params_item[$index]["size"] = "2";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "telefone_1";
		$params_item[$index]["caption"] = "Telefone 1";				
		$params_item[$index]["size"] = "10";
				
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "telefone_2";
		$params_item[$index]["caption"] = "Telefone 2";				
		$params_item[$index]["size"] = "10";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "telefone_3";
		$params_item[$index]["caption"] = "Telefone 3";				
		$params_item[$index]["size"] = "10";		

		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "telefone_4";
		$params_item[$index]["caption"] = "Telefone 4";				
		$params_item[$index]["size"] = "10";		

		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "fax";
		$params_item[$index]["caption"] = "Fax";
		$params_item[$index]["size"] = "10";		

		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "horario_funcionamento";
		$params_item[$index]["caption"] = "Horário de Funcionamento";
		$params_item[$index]["size"] = "70";
				
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "endereco_netcontabil";
		$params_item[$index]["caption"] = "Endereço do Net Contábil ex: (http://www.netcontabil.inf.br/seudominio.com.br)";
		$params_item[$index]["size"] = "90";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "chave_exportacao";
		$params_item[$index]["caption"] = "Chave Exportação";
		$params_item[$index]["size"] = "10";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "endereco_seguro";
		$params_item[$index]["caption"] = "Endereço seguro ex: (https://netcontabil.sslblindado.com/seudominio.com.br)";
		$params_item[$index]["size"] = "90";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "topo_boletim";
		$params_item[$index]["caption"] = "Coloque o Topo do Boletim";
		$params_item[$index]["size"] = "90";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "css_boletim";
		$params_item[$index]["caption"] = "Coloque o CSS na tag table do corpo do boletim";
		$params_item[$index]["size"] = "90";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "css_boletim_rodape";
		$params_item[$index]["caption"] = "Customize o Rodapé do Boletim";
		$params_item[$index]["size"] = "90";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "cor_boletim";
		$params_item[$index]["caption"] = "Coloque a cor do fundo do rodapé";
		$params_item[$index]["size"] = "10";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "logotipo";
		$params_item[$index]["caption"] = "Logotipo";
		$params_item[$index]["size"] = "90";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "pqec";
		$params_item[$index]["caption"] = "Digite o ano do selo do pqec";
		$params_item[$index]["size"] = "15";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "pqec_iso";
		$params_item[$index]["caption"] = "Digite o ano do selo do pqec + iso";
		$params_item[$index]["size"] = "15";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "css_cor";
		$params_item[$index]["caption"] = "CSS Customizado do Site";
		$params_item[$index]["size"] = "90";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_agenda";
		$params_item[$index]["caption"] = "Visualizar Agenda de obrigações?";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_cotacao";
		$params_item[$index]["caption"] = "Visualizar Cotação do Dólar ?";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_indices";
		$params_item[$index]["caption"] = "Visualizar Índices Econômicos ?";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_noticias";
		$params_item[$index]["caption"] = "Visualizar Notícias na Home ?";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_boletins";
		$params_item[$index]["caption"] = "Visualizar Boletins na Home ?";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_pagina_ferramentas";
		$params_item[$index]["caption"] = "Visualizar Menu Ferramentas ?";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_pagina_ferramentas";
		$params_item[$index]["caption"] = "Visualizar menu Ferramentas ?";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_pagina_ferramentas_indices";
		$params_item[$index]["caption"] = "Visualizar Índices em Ferramentas ?";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_pagina_ferramentas_indices";
		$params_item[$index]["caption"] = "Visualizar Índices em Ferramentas ?";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_pagina_ferramentas_consultas";
		$params_item[$index]["caption"] = "Visualizar Consultas em Ferramentas ?";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_pagina_ferramentas_tabelas";
		$params_item[$index]["caption"] = "Visualizar Tabelas em Ferramentas ?";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_pagina_ferramentas_certidoes";
		$params_item[$index]["caption"] = "Visualizar Certidões em Ferramentas ?";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_pagina_ferramentas_guias";
		$params_item[$index]["caption"] = "Visualizar Guias em Ferramentas ?";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_pagina_boletins";
		$params_item[$index]["caption"] = "Visualizar Menu Boletins ?";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_pagina_institucional";
		$params_item[$index]["caption"] = "Visualizar Menu Institucional ?";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_pagina_institucional_empresa";
		$params_item[$index]["caption"] = "Visualizar Empresa em Institucional ?";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_pagina_institucional_servicos";
		$params_item[$index]["caption"] = "Visualizar Serviços em Institucional ?";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_pagina_galeria_fotos";
		$params_item[$index]["caption"] = "Ativar página de Galeria de Fotos ?";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "visualizar_pagina_comparacao";
		$params_item[$index]["caption"] = "Visualizar página de comparação CLT ou PJ";
		$params_item[$index]["type"] = "SELECT";
				$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "codigo_coluna";
		$params_item[$index]["caption"] = "Código na Lateral do Site";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "codigo_rodape";
		$params_item[$index]["caption"] = "Código no Rodapé do Site";
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "personalizado";
		$params_item[$index]["caption"] = "Coloque S para site personalizado e deixe vazio ou em branco para Neo Site Padrão";
		$params_item[$index]["type"] = "SELECT";
		$i=0;
     			$params_item[$index]["options"][$i]["value"] = "S";
				$params_item[$index]["options"][$i]["caption"] = "Sim";
				$i++;
				$params_item[$index]["options"][$i]["value"] = "N";	
				$params_item[$index]["options"][$i]["caption"] = "Não";
		unset($i);
		
		$index++;
		$params_item[$index] = array();
		$params_item[$index]["name"] = "certificados";
		$params_item[$index]["caption"] = "Coloque a Imagem de outros Selos ou certificados da empresa";
				
		$inputs = get_inputs( $EMPRESA, $params_item, $mode, $sufix_dados_new, $sufix_dados_old);
?>

<table class="formeditar" align="center">
<col width="30%"/>
		<?php
			if ($mode=="insert"){
				$help = mount_help( $inputs[0]["help"] );
		?>
		<?php
			}
		?>
		<!-- FIXO se caso for consistir e der erro -->
		<input type="hidden" name="id_cliente" value="<?php echo $id_cliente;?>" />
<?php
		for( $i = 0; $i < count($inputs); $i++ ){
				$help = mount_help( $inputs[$i]["help"] );
				if ($inputs[$i]["caption"]=="CSS Customizado do Site"){
					if (request_session("USER")=="admin"){
						echo "<tr><th with='150' style=\"background-color:red;color:#FFFFFF\">".$inputs[$i]["caption"]. "</th>";
						echo "<td>$help</td><td>*Esse campo só aparece para o usuário admin. Clique na imagem do layout que mais se adequa a você se o campo estiver vazio você terá o layout padrão<br/>" .$inputs[$i]["input"]. "<br/> <img src=\"images/template_padrao.jpg\" id=\"img_padrao\"/> <img src=\"images/template_roxo.jpg\" id=\"img_roxo\" /></td></tr>";
					}
				}else if ($inputs[$i]["caption"]=="Coloque o Topo do Boletim"){
					if (request_session("USER")=="admin"){
						echo "<tr><th with='150' style=\"background-color:red;color:#FFFFFF\">".$inputs[$i]["caption"]. "</th>";
						echo "<td>$help</td><td>*Esse campo só aparece para o usuário admin.<br/>" .$inputs[$i]["input"]. "</td></tr>";
					}
				}else if ($inputs[$i]["caption"]=="Logotipo"){
					if (request_session("USER")=="admin"){
						echo "<tr><th with='150' style=\"background-color:red;color:#FFFFFF\">".$inputs[$i]["caption"]. "</th>";
						echo "<td>$help</td><td>*Esse campo só aparece para o usuário admin.<br/>" .$inputs[$i]["input"]. "</td></tr>";
					}
				}else if($inputs[$i]["caption"]=="Coloque a cor do fundo do rodapé"){
					if (request_session("USER")=="admin"){
						echo "<tr><th with='150' style=\"background-color:red;color:#FFFFFF\">".$inputs[$i]["caption"]. "</th>";
						echo "<td>$help</td><td>*Esse campo só aparece para o usuário admin.<br/>" .$inputs[$i]["input"]. "</td></tr>";
					}
				}else if ($inputs[$i]["caption"]=="Coloque S para site personalizado e deixe vazio ou em branco para Neo Site Padrão"){
					if (request_session("USER")=="admin"){
						echo "<tr><th with='150' style=\"background-color:red;color:#FFFFFF\">".$inputs[$i]["caption"]. "</th>";
						echo "<td>$help</td><td>*Esse campo só aparece para o usuário admin.<br/>" .$inputs[$i]["input"]. "</td></tr>";
					}
				}else if ($inputs[$i]["caption"]=="Coloque o CSS na tag table do corpo do boletim"){
					if (request_session("USER")=="admin"){
						echo "<tr><th with='150' style=\"background-color:red;color:#FFFFFF\">".$inputs[$i]["caption"]. "</th>";
						echo "<td>$help</td><td>*Esse campo só aparece para o usuário admin.<br/>" .$inputs[$i]["input"]. "</td></tr>";
					}
				}else if ($inputs[$i]["caption"]=="Customize o Rodapé do Boletim"){
					if (request_session("USER")=="admin"){
						echo "<tr><th with='150' style=\"background-color:red;color:#FFFFFF\">".$inputs[$i]["caption"]. "</th>";
						echo "<td>$help</td><td>*Esse campo só aparece para o usuário admin.<br/>" .$inputs[$i]["input"]. "</td></tr>";
					}		

				}else{
					echo "<tr><th with='150'>" .$inputs[$i]["caption"]. "</th>";
					echo "<td>$help</td><td>" .$inputs[$i]["input"]. "</td></tr>";
				}
		}
?>
</table>
<?php
	//$caminho = explode("/",$_SERVER["SCRIPT_NAME"]);
	
	//for ($i=0;$i<count($caminho)-1;$i++){
	//	$path_ckeditor.=$caminho[$i]."/";
	//}
	
	include "ckeditor/ckeditor.php";
	// Create a class instance.
	$CKEditor = new CKEditor();
	// Path to the CKEditor directory.
	$CKEditor->basePath = "ckeditor/";
	$CKEditor->config['width'] = 600;
	$CKEditor->config['height'] = 100;
	$CKEditor->config['toolbar'] = array(array('Image','Source'));
	if ($mode=="detail"){
		$CKEditor->config['readOnly'] = true;
	}
	
	if (request_session("USER")=="admin"){
		//Replace a textarea element with an id (or name) of "textarea_id".
		$CKEditor->replace("topo_boletim_dados_nv_0");
		$CKEditor->config['width'] = 400;
		$CKEditor->config['height'] = 100;
		$CKEditor->replace("logotipo_dados_nv_0");
		$CKEditor->replace("css_boletim_rodape_dados_nv_0");
	}	
	$CKEditor->replace("certificados_dados_nv_0");
	$CKEditor->replace("codigo_coluna_dados_nv_0");
	$CKEditor->replace("codigo_rodape_dados_nv_0");
?>	
<!-- CSS dos Diversos layouts -->

<div id="layout_padrao" style="display:none;"></div>
<div id="layout_roxo" style="display:none;">.camada1{background-image:url(imagens/roxo/fundo_faixa_header.png);}
.skin{background-image:url(imagens/roxo/topo_skin.png);}
aside{background-image:url(imagens/roxo/fundo_aside.png);}
.baseaside{background-image:url(imagens/roxo/base_aside.png);}
nav ul ul{background-image:url(imagens/roxo/fundo_submenu.png);}
nav ul li ul li:hover{background-image:url(imagens/roxo/fundo_submenu.png);}</div>

<?php 
	if ($mode=="edit"){
?>
	<script>
	$(document).ready(function(){
		$("#img_padrao").click(function(){
			$("#css_cor_dados_nv_0").val($("#layout_padrao").html());
		});
		$("#img_roxo").click(function(){
			$("#css_cor_dados_nv_0").val($("#layout_roxo").html());
		});
	});
	</script>
<?php
	}
?>
<!--
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#topo_boletim_dados_nv_0").ckeditor({
			<?php
				//if ($mode=="detail"){
			?>
			readOnly:true,
			<?php
				//}	
			?>
			width:500,
			height:100,
			toolbar:[['Image']]
		});
	})
</script>
-->