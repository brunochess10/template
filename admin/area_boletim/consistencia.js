	function consiste(form){
		ClearListErrors();
		var str = "";
		return ShowListErrors();
	}


	function CarregaBody(){
		LoadErrorsServidor();
		if ( document.formfields.NC_URL_SITE_netcontabil_nv ) {
				if( ! document.formfields.NC_URL_SITE_netcontabil_nv.disabled ) {
					document.formfields.NC_URL_SITE_netcontabil_nv.focus();
				}
		}
	}
