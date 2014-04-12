/*
 * Bruno Afonso Souza Brito, comentei o código feito pelo Theo para usar o código do menu com o jquery.  
 * 
 */
/*
		var div_active = null;
		var obj_drop = null;
		var startpopup = 0;
		
		var subdiv_active = null;
		var subobj_drop = null;
		var substartpopup = 0;

		

		function drop( id ){
				var now = new Date();
				endpopup = now.getSeconds();
				var seconds = endpopup - startpopup;
				if( seconds < 2 ){
						setTimeout("drop('" + id + "');", 2 - seconds );
				} else {
					obj = document.getElementById( id );
					if ( !obj.ativo ){
							//obj.src = obj.image_normal;
							var div = document.getElementById( obj.div );
                            if( div ) div.style.display = "none";
					}
				}
		}
		
		function subdrop( id ){
				var now = new Date();
				endpopup = now.getSeconds();
				var seconds = endpopup - substartpopup;
				if( seconds < 2 ){
						setTimeout("subdrop('" + id + "');", 2 - seconds );
				} else {
					obj = document.getElementById( id );
					if ( !obj.ativo ){
							//obj.src = obj.image_normal;
							var div = document.getElementById( obj.div );
							div.style.display = "none";
					}
				}
		}
		
		function MontaMenu( id, div ) {
				var menu = document.getElementById( id );
                if( menu ){
                       menu.div = div;
                       menu.ativo = false; 

        				menu.popup = function () {
        						var now = new Date();
        						startpopup = now.getSeconds();
        						if ( this.div != "" )	var div = document.getElementById(  this.div );
        				                if( div ){
            								if( ( div_active != div ) && ( div_active ) ) {
            										div_active.style.display = "none";
            										obj_drop = null;
            								}
                                            div.style.display = "";
                                        }
        								
        								div_active = div;
        								obj_drop = this;
        				}
        				
        				menu.onmouseover =  function () {
        						this.ativo = true;
        						
        						this.popup();
        						this.style.cursor = "pointer";
        				}
        				
        				menu.onmouseout = function () {
        						this.ativo = false;
        						
        						if ( this.div != "" ){ 
        							setTimeout("drop('" + this.id + "');",2000);
        						}else {
        							div_active = null;
        							obj_drop = null;
        						}
        						
        						this.style.cursor = "default";
        				}
                }

		}
		
		function MontaMenuItem( idpai, id, div){
				var menuitem = document.getElementById( id );
				menuitem.idpai = idpai;
				menuitem.ativo = false;
				menuitem.div = div;
				

				menuitem.popup = function () {
						//popup sub
						var now = new Date();
						substartpopup = now.getSeconds();
						var sub = document.getElementById( this.div );
                        if( sub )
    						if( ( subdiv_active) && ( sub != subdiv_active )  ){
    								subdiv_active.style.display = "none";
    								subdiv_active = null;
    								subobj_drop = null;
    								
    						} 
						if( sub ){ 
								sub.style.display = "";
								subdiv_active = sub;
								subobj_drop = this;
						}
				}
				
				menuitem.onmouseover = function () {
						this.ativo = true;
						var pai = document.getElementById( this.idpai );
						pai.ativo = true;
						this.popup();
						this.style.cursor = "pointer";
				}
				
				menuitem.onmouseout = function () {
						this.ativo = false;
						var pai = document.getElementById( this.idpai );
						pai.ativo = false;
						pai.onmouseout();
						var sub = document.getElementById( this.div );
						if ( sub )	
								setTimeout("subdrop('" + this.id + "');", 2000);
						this.style.cursor = "default";
				}
				
		}

		function carregamenu(){
				MontaMenu("principal_id");
				MontaMenu("empresa_id");
				MontaMenu("servicos_id");
                MontaMenu("boletins_id")

			/*
				MontaMenu("tabelas_id", "tabelas_sub_id" );
				MontaMenuItem("tabelas_id", "tabelas_item1" );
				MontaMenuItem("tabelas_id", "tabelas_item2" );
				MontaMenuItem("tabelas_id", "tabelas_item3" );
				MontaMenuItem("tabelas_id", "tabelas_item4" );
				MontaMenuItem("tabelas_id", "tabelas_item5" );
			*/
/*			
				MontaMenu("indices_id", "indices_sub_id" );
				MontaMenuItem("indices_id", "indices_item1" );
				MontaMenuItem("indices_id", "indices_item2" );
				MontaMenuItem("indices_id", "indices_item3" );
				MontaMenuItem("indices_id", "indices_item4" );
				MontaMenuItem("indices_id", "indices_item5" );
				MontaMenuItem("indices_id", "indices_item6" );
				MontaMenuItem("indices_id", "indices_item7" );
				
				MontaMenu("consultas_id");
				MontaMenu("certidoes_id");
				MontaMenu("formularios_id");
				MontaMenu("localizacao_id");
				MontaMenu("contato_id");

				 
		}
		
		window.onload = function () {
				carregamenu();
		}
*/



$(document).ready(function(){
	$(".submenu").hover(function(){
		$("#indices_sub_id").show();
	},function(){
		$("#indices_sub_id").hide();
	}
	)
})




