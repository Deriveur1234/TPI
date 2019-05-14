<?php 
// Projet: TPI
// Script: Modèle ModelEmailSender.php
// Description: Classe de gestions des envoient d'email
// Auteur: Loïc Burnand
// Version 1.0 PC 13.5.2019 / Codage initial

class ModelEmailSender
{
    static function SendEmail($Email)
    {
         // On doit créer une instance de transport smtp avec les constantes
        // définies dans le fichier mailparam.php
        $transport = Swift_SmtpTransport::newInstance(EMAIL_SERVER, EMAIL_PORT, EMAIL_TRANS)
        ->setUsername(EMAIL_USERNAME)
        ->setPassword(EMAIL_PASSWORD);

        try {
            // On crée un nouvelle instance de mail en utilisant le transport créé précédemment
            $mailer = Swift_Mailer::newInstance($transport);
            // On crée un nouveau message
            $message = Swift_Message::newInstance();
            // Le sujet du message
            $message->setSubject($Email->Subject);
            // Qui envoie le message 
            $message->setFrom(array(EMAIL_USERNAME => EMAIL_USERNAME));
            // A qui on envoie le message
            $message->setTo(array($Email->To));

            // Un petit message html
            // On peut bien évidemment avoir un message texte
            /*$body = 
            '<html>' .
            ' <head></head>' .
            ' <body>'.
            '  <p>Un petit message envoyé avec Swift Mailer 5.</p>' .
            ' </body>' .
            '</html>';*/
            // On assigne le message et on dit de quel type. Dans notre exemple c'est du html
            $message->setBody($Email->Body,'text/html');
            // Maintenant il suffit d'envoyer le message
            $result = $mailer->send($message);

        } catch (Swift_TransportException $e) {
            return "Problème d'envoi de message: ".$e->getMessage();
        }
        return true;
    }
}