<?php
/*
 * Functions outside cakePhp core
 */

/*
 * une fonction poru se connecter au serveur mysql en utilisant les infos de cakephp dans config/database.php
 */
function connect() {
//	App::import('Core', 'ConnectionManager');
	App::uses('ConnectionManager', 'Model');
	$dataSource = ConnectionManager::getDataSource('default');
	$login = $dataSource->config['login'];
	$password = $dataSource->config['password'];
	$database = $dataSource->config['database'];
	$link = mysql_connect("localhost", $login, $password)
    or die("Impossible de se connecter : " . mysql_error());
	$link=mysql_query("USE ".$database);
}

/*
 * pour ejecter les utilisateurs qui ne sont pas superadmin (su)
 */
function eject_non_admin() {
	//print_r($_SESSION);
	if($_SESSION['Auth']['User']['role_id']!="1") {         //non admin eject
		#if($session->read('Auth.User.role')!="Administrator") {         //non admin eject

		/*$this->Session->setFlash(__('Action not allowed!', true));*/
		echo "<h1>Action not allowed!</h1>";
		exit;
	}
}

/*
 * agrumes
*/

/*
 * calcul du prix
*
*/

function prix_du_legume($agrume) {
		//echo "<hr>agrume: " .$agrume ." quant : " .$quant ." pu: " .$pu ."<hr>"; exit;
	connect();
	$sql="
	SELECT prix FROM agrumes
	WHERE id=".$agrume;
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$prixleg=mysql_result($sql,0,'prix');
return $prixleg;
}
function prix($agrume,$quant,$pu) {
	//echo "<hr>agrume: " .$agrume ." quant : " .$quant ." pu: " .$pu ."<hr>"; exit;
	connect();
	$sql="
	SELECT prix FROM agrumes
	WHERE id=".$agrume;
	//echo $sql;
	$sql=mysql_query($sql);
	if(!$sql) {
	echo "SQL error: " .mysql_error(); exit;
	}
	$prix=mysql_result($sql,0,'prix');
	//echo $prix;
	$prix=intval($prix*$quant);
	//echo $prix;
	//return $prix ;
}

/* prix à payer pour un membre */


function prix_total_user($user,$etat) {
	connect();
/*
 * grandtotal, paye, paspaye
 */
	$sql="
	SELECT sum( commandes.quant * agrumes.prix ) AS total
	FROM commandes, agrumes
	WHERE commandes.user_id =".$user ."
	AND agrumes.id = commandes.agrume_id";
	if($etat=='paye') {
	$sql.=" AND commandes.paied =1";
	} elseif($etat=='paspaye') {
	$sql.=" AND commandes.paied =0";
	}
	//echo $sql ."<br>";
	$solde=0;
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	//	echo mysql_result($sql,0,'total');exit;
	$solde=intval(mysql_result($sql,0,'total'));

	return $solde;
	//echo $solde;
}
/* prix à payer pour un groupe */


function prix_total_groupe($groupe) {
	connect();
	
	$sql="
	SELECT sum( commandes.quant * agrumes.prix ) AS total
FROM commandes, users, agrumes
WHERE users.groupe_id =".$groupe ." 
AND users.id = commandes.user_id
AND agrumes.id = commandes.agrume_id
AND commandes.paied =0";
	//echo $sql ."<br>";
	$solde=0;
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
//	echo mysql_result($sql,0,'total');exit;
	$solde=mysql_result($sql,0,'total');
	
	return $solde;
	echo $solde;
}


/* prix à payer pour un membre */
function prix_total($user) {
	connect();
	$sql="
	SELECT * FROM commandes 
	WHERE user_id=".$user;
	//echo $sql ."<br>";	
	$solde=0;
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$i=0;
	while($i<mysql_num_rows($sql)) {
		$prix=prix(mysql_result($sql,$i,'agrume_id'), mysql_result($sql,$i,'quant'));
		$solde=$solde+$prix;
		$i++;
	}
	return $solde;
	echo $solde;
}

function prix_total_paye($user) {
	connect();
	$sql="
	SELECT * FROM commandes
	WHERE user_id=".$user ." 
	AND paied=1";
	//echo $sql ."<br>";
	$solde=0;
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$i=0;
	while($i<mysql_num_rows($sql)) {
		$prix=prix(mysql_result($sql,$i,'agrume_id'), mysql_result($sql,$i,'quant'));
		$solde=$solde+$prix;
		$i++;
	}
	return $solde;
	echo $solde;
}

function solde($user) {
	connect();
	$sql="
	SELECT * FROM commandes
	WHERE user_id=".$user ."
	AND paied=0";
	//echo $sql ."<br>";
	$solde=0;
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$i=0;
	while($i<mysql_num_rows($sql)) {
		$prix=prix(mysql_result($sql,$i,'agrume_id'), mysql_result($sql,$i,'quant'));
		$solde=$solde+$prix;
		$i++;
	}
	return $solde;
	echo $solde;
}
	
function agrume_lib($id) { //retourne le nom de l'agrume
	connect();
	$sql="
	SELECT lib FROM agrumes
	WHERE id=".$id;
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	echo mysql_result($sql,0,'lib') ;
}

/*
 * livraisons
 */

function livraison_date($id) { //retourne la datede la prochaine livraison
	connect();
	$sql="
	SELECT date FROM livraisons
	WHERE id=".$id;
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$dateprochainelivraison.= dateSQLlong2fr(mysql_result($sql,0,'date')) ;
	return $dateprochainelivraison;
}

function prochainelivraisonid() { //retourne uniquement l'id de la prochaine livraison
	connect();
	$sql="
	SELECT id FROM livraisons
	ORDER BY date DESC
	";
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$dateprochainelivraison.= mysql_result($sql,$i,'id') ;
	return $dateprochainelivraison;
}

function prochainelivraison($n) { //date de livraison, texte, limité à $n
	if(!$n){
		$n=1;
	}
	connect();
	$sql="
	SELECT date FROM livraisons
	ORDER BY date DESC 
	LIMIT 0,2" .$n;
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$i=0;
	while($i<mysql_num_rows($sql)) {
	$dateprochainelivraison.= dateSQLlong2fr(mysql_result($sql,$i,'date')) ." ";
	$i++;
	}
	return $dateprochainelivraison;
}


/*
 * users
 */

function roles(){
	connect();
	$sql="
	SELECT * FROM roles
	ORDER BY lib
	";
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$i=0;
	while($i<mysql_num_rows($sql)){
		echo "<option value=\"" .mysql_result($sql,$i,'id') ."\">";
		echo mysql_result($sql,$i,'lib');
		echo "</option>";
		$i++;
	}
}


function groupes(){
	connect();
	$sql="
	SELECT * FROM groupes 
	ORDER BY lib
	";
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$i=0;
	echo "<option>pas de groupe</option>";
	while($i<mysql_num_rows($sql)){
		echo "<option value=\"" .mysql_result($sql,$i,'id') ."\">";
				echo mysql_result($sql,$i,'lib');
		echo "</option>";		
		$i++;
	}	
}

function groupe($groupe){
	connect();
	$sql="
	SELECT * FROM groupes
	WHERE  id=" .$groupe;
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
		echo mysql_result($sql,0,'lib');
}
function parents(){
	connect();
	$sql="
	SELECT id,username FROM users
	ORDER BY username
	";
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$i=0;
	echo "<option value=\"0\" selected>pas de parent</option>";
	while($i<mysql_num_rows($sql)){
		echo "<option value=\"" .mysql_result($sql,$i,'id') ."\">";
		echo mysql_result($sql,$i,'username');
		echo "</option>";
		$i++;
	}
}

function parent($user){
	connect();
	$sql="
	SELECT username FROM users
	WHERE id=".$user;
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}

		$parent= mysql_result($sql,0,'username');
		return $parent;

}


function  liste_commandes_parent($user) {
	connect();
	$sql="
	select * FROM commandes
	 WHERE 
	 user_id IN (
	SELECT id FROM users
	WHERE id=".$user ." OR parent_id=".$user .")
	GROUP BY user_id
	";
	echo "<br>".$sql."<hr>"; 
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
	$i=0;
	//echo "<option value=\"0\" selected>pas de parent</option>";
	while($i<mysql_num_rows($sql)){
	//	echo "<option value=\"" .mysql_result($sql,$i,'id') ."\">";
		echo mysql_result($sql,$i,'user_id');
		echo "<br>";
	//	echo "</option>";
		$i++;
	}
}


function check_usergroup($user,$groupe) {
	
	connect();
	$sql="
	SELECT * FROM users
	WHERE id=".$user;
	$sql=mysql_query($sql);
	if(!$sql) {
		echo "SQL error: " .mysql_error(); exit;
	}
		if(mysql_result($sql,0,'groupe_id')!=$groupe) {
	echo '	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		
	echo "Désolé, vous ne pouvez voir que les membres de votre groupe";
		
	exit;
		}
}

/*
 * tools
 */	

function urlize($chaine) { 
/* 
 * replace urls with links a href=http://... */
	$chaine = preg_replace("/(https:\/\/)(([[:punct:]]|[[:alnum:]]=?)*)/","<a target=\"_blank\" href=\"\\0\">\\0</a>",$chaine);
	$chaine=preg_replace("/(http:\/\/)(([[:punct:]]|[[:alnum:]]=?)*)/","<a target=\"_blank\" href=\"\\0\">\\0</a>",$chaine);
	//exclude emails
	if(!preg_match("/[a-zA-Z0-9]*\.[a-zA-Z0-9]*@/",$chaine)){
	}else {
	$chaine = preg_replace('/[-a-zA-Z0-9]*\.?[-a-zA-Z0-9!#$%&\'*+\/=?^_`{|}~]+@([.]?[a-zA-Z0-9_\/-])*/','<a href="mailto:\\0">\\0</a>',$chaine);	
	}
	echo nl2br($chaine);
	
}

/*
 * dates
 * 
 */

/*convert SQL date time to french date*/
function dateSQL2fr($date) {
	$date=explode(" ", $date);
	$hour=$date[1];
	$date=$date[0];
	$date=explode("-", $date);
	//	$date=mktime(0,0,0,$date[2],$date[1],$date[0]);
	$date=mktime(0,0,0,$date[1],$date[2],$date[0]);
	echo strftime("%a, %d-%m-%Y", $date);
}

/*convert SQL long date time to french date*/
function dateSQLlong2fr($date) {
	if($date>1000000000) {
		//unixtime
		$timestamp=$date;
	} else {
		$timestamp=strtotime($date);
	}
	//echo $date;
	$date_mod= date('D, d M Y H:i',$timestamp);
	$today1=dateen2fr($date_mod);
	echo $today1;
}

/*same but no day name (shorter)*/
function dateSQL2frSmall($date) {
	$date=explode(" ", $date);
	$hour=$date[1];
	$date=$date[0];
	$date=explode("-", $date);

	$date=mktime(0,0,0,$date[1],$date[2],$date[0]);
	echo strftime("%d-%m-%Y", $date);
}

/*convert english short date to french short date*/
function dateen2fr($today1) {
	#mois en francais - attention à le faire dans ce sens car Mar(s) < Mardi !
	$today1 = preg_replace("/Jan/", "Janvier", $today1);
	$today1 = preg_replace("/Feb/", "Février", $today1);
	$today1 = preg_replace("/Mar/", "Mars", $today1);
	$today1 = preg_replace("/Apr/", "Avril", $today1);
	$today1 = preg_replace("/May/", "Mai", $today1);
	$today1 = preg_replace("/Jun/", "Juin", $today1);
	$today1 = preg_replace("/Jul/", "Juillet", $today1);
	$today1 = preg_replace("/Aug/", "Août", $today1);
	$today1 = preg_replace("/Sept/", "Septembre", $today1);
	$today1 = preg_replace("/Oct/", "Octobre", $today1);
	$today1 = preg_replace("/Nov/", "Novembre", $today1);
	$today1 = preg_replace("/Dec/", "Décembre", $today1);

	$today1 = preg_replace("/Mon/", "Lundi", $today1);
	$today1 = preg_replace("/Tue/", "Mardi", $today1);
	$today1 = preg_replace("/Wed/", "Mercredi", $today1);
	$today1 = preg_replace("/Thu/", "Jeudi", $today1);
	$today1 = preg_replace("/Fri/", "Vendredi", $today1);
	$today1 = preg_replace("/Sat/", "Samedi", $today1);
	$today1 = preg_replace("/Sun/", "Dimanche", $today1);

	//$today1=preg_replace("/-/"," ", $today1);
	/*
	 * on nettoie sir l'heure n'est pas définie
	 */
	$today1=preg_replace("/ 00:00$/","",$today1);
	return $today1;
}


?>

