<?php
if(isset($_POST['mailform']))
{
    if(!empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['message']))
    {
        $header="MIME-Version: 1.0\r\n";
        $header.='From:"PrimFX.com"<support@primfx.com>'."\n";
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

        mail("jonjon.joz114@gmail.com", "CONTACT - Monsite.com", $message, $header);
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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
        <title>Billet simple pour l'Alaska</title>
    </head>

    <body>

        <?php include('header.php'); ?>

        <section>

            <div class="preview">

                <form method="POST" action="">
                    <p>
                        <label for="chapterName">Votre nom et prénom :</label><br/>
                        <input type="text" name="nom" placeholder="ex : Jean Foreteroche" value="<?php if(isset($_POST['nom'])) { echo $_POST['nom']; } ?>" /><br /><br />
                    </p>
                    <p>
                        <label for="chapterName">Votre mail :</label><br/>
                        <input type="email" name="mail" placeholder="ex : jean.foreteroche@gmail.com" value="<?php if(isset($_POST['mail'])) { echo $_POST['mail']; } ?>" /><br /><br />
                    </p>
                    <p>
                        <label for="chapterName">Votre message :</label><br/>
                        <textarea name="message" placeholder="ex : Wouaaah ton histoire est cool ! En plus le site est super bien fait !!" cols="90" rows="10"><?php if(isset($_POST['message'])) { echo $_POST['message']; } ?></textarea><br /><br />
                    </p>
                    
                    <input type="submit" value="Envoyer" name="mailform"/>
                </form>

                <?php
                if(isset($msg))
                {
                    echo $msg;
                }
                ?>
            </div>
            
        </section>

    </body>

</html>