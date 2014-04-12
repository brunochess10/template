<?php

class Facebook {
	
	
    function Facebook_comentario($url){
        $this->load->model('Midias_model');
        $resultado = $this->Midias_model->get_conteudo_midias();
        
        if ($resultado[0]->ativar_facebook_comentario=="S"){
            $facebook_code = "
            <div id=\"fb-root\"></div>
            <div id=\"fb-root\"></div>
            <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = \"//connect.facebook.net/pt_BR/all.js#xfbml=1\";
            fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            <meta property=\"fb:admins\" content=\"".$resultado[0]->user_facebook_id."\"/>
            <div class=\"fb-comments\" data-href=\"".site_url($url)."\" data-num-posts=\"6\" data-width=\"470\"></div>
            ";
        }else{
            $facebook_code ="";
        }
        return $facebook_code;
    }
    
    function curtir(){
		$this->load->model('Midias_model');
        $resultado = $this->Midias_model->get_conteudo_midias();
		if ($resultado[0]->url_fan_page==""){
			$url_curtir = site_url(); 
		}else{
			$url_curtir = $resultado[0]->url_fan_page; 
		}
        return  "<iframe src=\"http://www.facebook.com/plugins/like.php?href=".$url_curtir."&layout=box_count&show_faces=false&width=380&action=like&colorscheme=light&height=100&locale=pt_BR\" scrolling=\"no\" frameborder=\"0\" style=\"border:none; overflow:hidden; width:200px; height:100px; color:#FFFFFF\" allowTransparency=\"true\"></iframe>";
    }
}
?>
