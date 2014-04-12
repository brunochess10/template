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
        for ($i = 1; $i <= $count; $i++) {
            $url = "http://twitter.com/statuses/user_timeline/$usuario.xml?count=$i";
            $xml = simplexml_load_file($url) or die("Falha ao conectar com o servidor do Twitter.");
            foreach ($xml->status as $status) {
                $ultimo = $status->text;
            }
            echo "<p>" . $ultimo . "</p>";
        }
    }

}

?>
