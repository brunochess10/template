<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tweetaki
 *
 * @author ox
 */
class Tweetaki {

    public function ultimosTweets($usuario, $count) {
        $xml = simplexml_load_file("https://api.twitter.com/1/statuses/user_timeline.rss?screen_name=$usuario");
	    $twit="<ul>";
	    //for ($i=0;$i<$count;$i++){
		//	$texto = str_replace("$usuario:","",$xml->channel->item[$i]->title);
		//	$twit.="<li><a href=\"".$xml->channel->item[$i]->link."\" target=\"_blank\">$texto</a></li>";
	    //}
		$twit.=file_get_contents("http://www.netcontabil.com.br/twitter/index.php?usuario=$usuario&count=$count");
		$twit.="</ul>";
        return $twit;
    }

    function seguir_twitter(){
        
        $this->load->model("Midias_model");
        $resultado = $this->Midias_model->get_conteudo_midias();
        
        if ($resultado[0]->ativar_seguir_twitter=="S"){
            $follow ="
                <a href=\"https://twitter.com/".$resultado[0]->user_twitter_id."\" class=\"twitter-follow-button\" data-show-count=\"false\" data-lang=\"pt\">Seguir @".$resultado[0]->user_twitter_id."</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=\"//platform.twitter.com/widgets.js\";fjs.parentNode.insertBefore(js,fjs);}}(document,\"script\",\"twitter-wjs\");</script>
            ";
        }else{
            $follow="";
        } 
        return $follow;
       }
}

?>
