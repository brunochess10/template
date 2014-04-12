<?php


class Load_twitter extends CI_Controller {
    
    function index(){
		$conta_twitter="";
		$conta_twitter = $this->input->get("conta_twitter");
		echo Tweetaki::ultimosTweets($conta_twitter,3);
	}
    
}

?>