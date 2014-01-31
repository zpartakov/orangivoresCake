<?php
//password reminder

$this->pageTitle = "Envoyer un nouveau mot de passe";
?> 
<h1><? echo $this->pageTitle; ?></h1>
Veuillez compléter les champs ci dessous pour obtenir un nouveau mot de passe pour votre compte sur "a magna'!".<br /> 
Un email avec votre nouveau mot de passe vous sera envoyé à l'adresse de courriel utilisée lors de votre enregistrement. 
<br />
<br />
<form id="form_id" action="<? echo CHEMIN; ?>users/renvoiemail"  onsubmit="javascript:return validate_email('form_id','email');">
Votre email: <input type="text" name="email">
<input type="submit" value="Renvoyer le mot de passe">
</form>
<br />
<ul>
<li>Vous n'avez pas encore de compte?</li>
<li>Le système de renvoi ne marche pas?</li>
<li>Vous avez changé d'email?</li>
</ul>
<br />
-> Veuillez utiliser le <a href="<? echo CHEMIN; ?>contact/contacts/add">formulaire de contact</a>

