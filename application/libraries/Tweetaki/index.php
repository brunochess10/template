<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body style="background: #f1f1f1;
                 font-family: arial, verdana; font-size: 13px;">

        <div id="logo" style="margin-left: 46%; margin-top: 3%;
                              width: 66px; height: 34px;">
        </div>
        
        <div id="form" style="float: left; 
                              margin-left: 32%; margin-top: 10%;
                              color: grey;
                              font-weight: bold;">

            <form method="GET" action="tweets.php">
                <label id="twitterUserLabel" for="twitterUserInput" style="margin-left: 27px;">Usuário do Twitter: </label>
                <input id="twitterUserInput" type="text" name="twitterUser"/>

                <br/>

                <label id="quantidadeTweetsLabel" for="quantidadeTweetsInput">Quantidade de Tweets: </label>
                <input id="quantidadeTweetsInput" type="text" name="quantidadeTweets" value="" />

                <input type="submit" value="Atualizar"/>
            </form>

        </div>
        
    </body>
</html>
