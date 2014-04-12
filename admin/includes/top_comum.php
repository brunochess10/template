<?php include("includes/top.php"); ?>


<table class="conteudo">
<col width="230"/>
	<tr>
		<td class="menu">
			<?php
				##################################
				# BUSCAR PERMISSÕES PARA MENU
				##################################
				//processo
				//$allow_insert_processo =  is_allowed( request_session("USER_NIVEL"), "processo", "insert");
				//$allow_pesquisa_processo = is_allowed( request_session("USER_NIVEL"), "processo", "search");
				//$allow_edit_andamento = is_allowed( request_session("USER_NIVEL"), "processo_andamento", "edit");

			?>

			Buscar e-mail
			<form name="formcliente" action="robo_pesquisa.php" method="post" onsubmit="return set_query(this);">
			<?php echo $sid_post?>
			<input type="hidden" name="mod"  value="usuarios">
			<input type="hidden" name="allwords" value="yes">
			<input type="text" name="query" style="width:150px;"  maxlength="30" onfocus="ativabtn('btn_autor')" onblur="desativabtn('btn_autor')">
			<input type="submit" class="botao" value="ok" style="width:30px;" id="btn_autor"><br>
			</form>
			<!-- <hr> -->
			<br>
			
			<br>
			<a href="area_usuario.php?<?php echo $sid_get ?>"><li>Área Usuário</li></a>
			<!--
			###############################################
			# SUBMENU AUTOR
			###############################################
			-->
			
			<!-- MENU EXEMPLO 
			<table class="sub">
				<tr>
					<th>Autor/Réu</th>
				</tr>
				<?php //if ( is_allowed( request_session("USER_NIVEL"), "autor", "insert") ){?>
				<tr>
					<td><a href="robo_inserir.php?<?//=show($sid_get)?>&mod=autor" style="width:100%;"> Inserir<a/></td>
				</tr>
				<?php// } ?>
				<tr>
					<td><a href="robo_pesquisa.php?<?//=show($sid_get)?>&mod=autor&allwords=yes" style="width:100%;"> Pesquisar<a/></td>
				</tr>
				<?php //if ( is_allowed( request_session("USER_NIVEL"), "autorizar_autor", "edit") ){?>
				<tr>
					<td><a href="autorizar_autor.php?<?//=show($sid_get)?>" style="width:100%;"> Autorizar<a/></td>
				</tr>
				<?php //} ?>

				<? //if ( is_allowed( request_session("USER_NIVEL"), "autor", "report") ){?>
				<!-- <tr>
					<td><a href="robo_filtro.php?<?//=show($sid_get)?>&mod=autor" style="width:100%;"> Relatório</a></td>
				</tr> 
                <?php //} ?>
			 FIM DO AUTOR -->
			<!--
			<!--<hr/>-->
			<br>
			<br>
			
			
			<?php
						
			/*
			* O trecho abaixo busca módulo por módulo o arquivo menu.php
			* No arquivo menu.php ele monta todos os grupos e subgrupos
			*/
			
			
			$path_modulo="";
			$path_os = (strtoupper(substr(PHP_OS, 0, 3)) === "WIN") ? "\\" : "/";
			$aux_dir_modulo = explode($path_os,dirname(__FILE__));
			for ($i=0;$i<count($aux_dir_modulo)-1;$i++){
				$path_modulo.=$aux_dir_modulo[$i]."/";
			}
			
			
			//$path = $path;
			$diretorio = dir($path_modulo);
			
			while($arquivo = $diretorio->read()){
				  if ((file_exists($path_modulo.$arquivo."/menu.php"))&&($arquivo!="includes")){
					if (($personalizado==true)&&(file_exists($path_modulo.$arquivo."/personalizado.txt"))){
						include $path_modulo.$arquivo."/menu.php";
					}
					if ($personalizado==false){
						include $path_modulo.$arquivo."/menu.php";
					}	
				  }
			}
			$diretorio->close();
			
			function normalize_array($array){
				$newarray = array();
				$array_keys = array_keys($array);
				$i=0;
				foreach($array_keys as $key){
					$newarray[$i] = $array[$key];
				$i++;
				}
				return $newarray;
			}
			
			ksort($grupo);
			ksort($menu);
			$grupo_aux = normalize_array($grupo);
			$menu_aux = normalize_array($menu);
				
			/*for ($i=0;$i<count($grupo_aux);$i++){
			    echo "<fieldset>";
				echo "<legend>".$grupo_aux[$i]."</legend>";
				for ($j=0;$j<count($menu_aux[$i]);$j++){
				    echo $menu_aux[$i][$j];
				}
				echo "</fieldset>";
			}*/
			
			
			foreach ($grupo_aux as $aux_grupo_menu=>$key_grupo_menu){
				echo "<fieldset>";
				echo "<legend>".$grupo_aux[$aux_grupo_menu]."</legend>";
				ksort($menu_aux[$aux_grupo_menu]);
				foreach ($menu_aux[$aux_grupo_menu] as $aux_m=>$key_menu){
					echo $menu_aux[$aux_grupo_menu][$aux_m];
				}
				echo "</fieldset>";
			}
			
			?>
		
			<br/>
			<iframe src="nunca_expira.php?<?php echo $sid_get;?>"	style="display:none;"></iframe>
			<a href="javascript:encerrar();"><li>Sair do Sistema</li></a>
            <br/><br/>
			<br/><br/>
			<br/><br/>
			<br/><br/>
			<br/><br/>
		</td>
		<td style="padding:0;">
