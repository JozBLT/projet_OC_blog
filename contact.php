<?php
if(isset($_POST['mailform']))
{
    if(!empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['message']))
    {
        $header="MIME-Version: 1.0\r\n";
        $header.='From:"BilletSimpleAlaska.com"<billetsimplealaska@contact.com>'."\n";
        $header.='Content-Type:text/html; charset="uft-8"'."\n";
        $header.='Content-Transfer-Encoding: 8bit';

        $message='
        <html>
            <body>
                <div align="center">
                    <u>Nom de l\'expéditeur :</u>'.$_POST['nom'].'<br />
                    <u>Mail de l\'expéditeur :</u>'.$_POST['mail'].'<br />
                    <br />
                    '.nl2br($_POST['message']).'
                </div>
            </body>
        </html>
        ';

        mail("jonjon.joz114@gmail.com", "CONTACT - BilletSimpleAlaska.com", $message, $header);
        $msg="Votre message a bien été envoyé !";
    }
    else
    {
        $msg="Tous les champs doivent être complétés !";
    }
}
?>


<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css" />
        <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        <title>Billet simple pour l'Alaska</title>
    </head>

    <body>

        <?php include('header.php'); ?>

        <section>

            <div id="contact">
                <h2>Envoyez moi un mail !</h2>

                <form method="POST">
                    
                    <input type="text" name="nom" placeholder="Votre nom complet" value="<?php if(isset($_POST['nom'])) { echo $_POST['nom']; } ?>" /><br /><br />
                

                    <input type="email" name="mail" placeholder="Votre adresse mail" value="<?php if(isset($_POST['mail'])) { echo $_POST['mail']; } ?>" /><br /><br />
                

                    <textarea name="message" placeholder="Votre message !" cols="90" rows="10" onkeyup="adjust_textarea(this)"><?php if(isset($_POST['message'])) { echo $_POST['message']; } ?></textarea><br /><br />
                
                    
                    <input type="submit" class="button" id="btn_mail" name="mailform" value="Envoyer"/>

                </form>

                <?php
                if(isset($msg))
                {
                    echo $msg;
                }
                ?>
            </div>
            
        </section>

        <script type="text/javascript">
        //auto expand textarea
        function adjust_textarea(h) {
            h.style.height = "20px";
            h.style.height = (h.scrollHeight)+"px";
        }
        </script>

    </body>

</html>