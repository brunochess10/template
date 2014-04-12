<script>
$(document).ready(function(){
				  $("#remuneracao").priceFormat({
					prefix:'',
					centsSeparator:',',
					thousandsSeparator:''
				  })
				  
				  $("#aliq_iss").priceFormat({
					prefix:'',
					centsSeparator:',',
					thousandsSeparator:''
				  })
				  
				  $("#aliq_simples").priceFormat({
					prefix:'',
					centsSeparator:',',
					thousandsSeparator:''
				  })
				  
				  
				  $("#bot_comparar").click(function(){
					
					var isChecked = $('#optante_simples').attr('checked')?true:false;
					if (isChecked){
						var optante_simples_var = $("#optante_simples").val();
					}else{
						var optante_simples_var = "";
					}
					
					
					var remuneracao_var = $("#remuneracao").val();
					var aliq_iss_var = $("#aliq_iss").val();
					var aliq_simples_var = $("#aliq_simples").val();
					
					if (remuneracao_var!=""){
						$.post("{site_url}load_compara",{optante_simples: optante_simples_var, remuneracao: remuneracao_var, aliq_iss :aliq_iss_var, aliq_simples: aliq_simples_var  },
							function(data){
								$("#resposta_calculo").html(data)
							}
						)
					}else{
						alert('Por favor preencha a remuneração')
					}
					return false;
				  })
})				  
</script>
<section class="conteudo">
            <h1 class="title_home">Comparação CLT ou PJ</h1>
			<p>Faça uma análise com essa ferramenta para verificar se compensa abrir uma empresa, ser contratado como CLT ou se ser autônomo, é a melhor solução.</p>
			<br/>
			<br/>
			<form id="compara" method="post">
			<fieldset style="border:solid 1px;padding:10px 10px 10px 10px">
				<legend>Dados do Contratante</legend>
					<table>
					<tr>
						<td colspan="3">
							<input type="checkbox" name="optante_simples" id="optante_simples" value="S"  />Contratante Optante Simples Nacional         
						</td>
					</tr>
					</table>
			</fieldset>
			<fieldset  style="border:solid 1px;padding:10px 10px 10px 10px">
				<legend>Dados da Contratada</legend>	
					<table>
					<tr>
						<td width="25%">Remuneração</td>
						<td>R$</td>
						<td width="65%"><input type="text" name="remuneracao"  id="remuneracao" size="15" maxlength="15" style="text-align:right"/> </td>
					</tr>
					<tr>
						<td>Aliquota ISS</td>
						<td>%</td>
						<td><input type="text" name="aliq_iss" id="aliq_iss" size="15" maxlength="15"  style="text-align:right"/></td>
					</tr>
					<tr>
						<td>*Aliquota Simples</td>
						<td>%</td>
						<td><input type="text" name="aliq_simples" id="aliq_simples" size="15" maxlength="15" style="text-align:right" /></td>
					</tr>
					<tr>
						<td colspan="3"><small>*Se você preencher a "Alíquota do Simples" o programa vai considerar que a empresa a ser aberta será optante do simples nacional </small></td>
					</tr>
					<tr>
						<td colspan="3">
							<input type="submit" value="Comparar" id="bot_comparar" />
						</td>
					</tr>
					</table>
			</fieldset>	
		</form>	
		<div id="resposta_calculo"></div>
</section>