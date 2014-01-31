<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'functions');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {
/**
 * Components
 *
 * @var array
 */
	public $components = array(
			'Auth' => array(
					'authenticate' => array(
							'Form' => array(
									'passwordHasher' => array(
											'className' => 'Simple',
											'hashType' => 'sha1'
									)
							)
					)
			), 'Paginator'
	);
	
	function beforeFilter() {
		$this->Auth->allow(
				'login','logout','passwordreminder', 'renvoiemail', 
				'confirmation', 'inscription', 'inscriptionok',
				'activate'
				);
	
	}

	var $paginate = array(
			'limit' => 30,
			'order' => array(
					'User.identifiant' => 'asc'
			)
	);

/**
 * index method
 *
 * @return void
 */
	public function index() {
		eject_non_admin();
		$this->Paginator->settings = $this->paginate;
		
		if($this->data['User']['q']||$_GET['q']) {
			if($this->data['User']['q']) {
				$q = $this->data['User']['q'];
			} elseif($_GET['q']) {
				$q = $_GET['q'];
			}
			$options = array(
					"User.username LIKE '%" .$q ."%'
					OR User.nom LIKE '%" .$q ."%'
					OR User.prenom LIKE '%" .$q ."%'
					OR User.email LIKE '%" .$q ."%'
					"
			);
			$this->set(array('users' => $this->paginate('User', $options)));
		} else {
		$this->set('users', $this->Paginator->paginate());
		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}
	
	/**
	 * parent method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function parent($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));	
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$parents = $this->User->find('list');
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				
				if($_SESSION['Auth']['User']['role_id']!='1') {
					/*
					 * menu super-admin
					*/
				/*
				 * send email notification
				*/
				//$Destinataire = "fradeff@akademia.ch";
				$Destinataire = ADMINEMAIL;
				$Sujet = "Nouvel utilisateur " .SITE;
				
				$From  = "From: " .$this->data['User']['email'] ."\n";
				$From .= "MIME-version: 1.0\n";
				$From .= "Content-type: text/html; charset= UTF-8\n";
				
				$Message = "Nouvel utilisateur enregistré à confirmer: " .$this->data['User']['email'] ."
					
				Pour confirmer: http://" .SERVERNAME .CHEMIN ."/users/confirmer?email=" .$this->data['User']['email'] ."
				----
				Ne pas répondre à cet email
				Message automatique
				";
				$envoie=mail($Destinataire,$Sujet,$Message,$From);
				if(!$envoie) {
					echo "Problem sending email!";
				}
				}
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {		
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$utilisateurs = $this->User->find('list');
		$roles = $this->User->Role->find('list');
		$groupes = $this->User->Groupe->find('list', array('order' => array('Groupe.lib ASC')));
		$this->set(compact('roles', 'groupes','utilisateurs'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

public function login() {
    if ($this->request->is('post')) {
  	
        if ($this->Auth->login()) {
        	//if($_SESSION['Auth']['User']['role_id']!='1') {
        		//on ne redirige pas si superadmin
            return $this->redirect(array('action' => 'loggedin'));
        	/*} else {
        	return $this->redirect($this->referer());
        	}*/
        } else {
            $this->Session->setFlash(__('Nom d\'user ou mot de passe invalide, réessayer'));
        }
    }
}

public function logout() {
    $this->redirect($this->Auth->logout());
}

public function loggedin() {
}

/**
 * inscription method
 *
 * @return void
 */
public function inscription() {
	if ($this->request->is('post')) {
//echo $this->request->data['User']['confirmpassword'];exit;
		$this->request->data['User']['parent_id']=0;
		$this->request->data['User']['groupe_id']=0;
		$this->request->data['User']['role_id']=3;
		$this->request->data['User']['status']=0;
		$this->request->data['User']['last_connection']=date("Y-m-d h:i:s");
		
		$this->User->create();
		if ($this->User->save($this->request->data)) {
			$key=sha1(Configure::read('Security.salt2hash').$this->request->data['User']['email']);

			$Destinataire=$this->request->data['User']['email'];
			$url="http://".SERVERNAME.CHEMIN ."/users/activate?key=".$key
			."&email=".$Destinataire
			."&id=".$this->User->getLastInsertID();
			$Sujet = "Vos informations de connexion à \"".SITE."\"";
			
			$From  = "From: " .ADMINEMAIL ."\n";
			$From .= "MIME-version: 1.0\n";
			$From .= "Content-type: text/html; charset= UTF-8\n";
			
			$Message = "Bonjour, 
			
			Voici vos informations de connexion à \"".SITE.":
			
			Identifiant (login):     " .$this->request->data['User']['username'] ."
			Mot de passe (password): " .$this->request->data['User']['confirmpassword'] ."
			
			Pour vous enregistrer: <a href=\"".$url."\">".$url."</a>
			
			Nous vous souhaitons un bon accueil à \"".SITE."\"
			----
			Cet email a été généré par un script automatique
			";
			$Message=nl2br($Message);
			$envoie=mail($Destinataire,$Sujet,$Message,$From);
			if(!$envoie) {
				echo "Problem sending email!";
			}
			
			return $this->redirect(array('action' => 'inscriptionok?id='.$this->User->getLastInsertID()));
		} else {
			$this->Session->setFlash(__('Problème. Merci d\'essayer à nouveau.'));
		}
	}
}
public function activate() {
	
	/*
	 * 
	 */
	$this->layout="";
	$key=sha1(Configure::read('Security.salt2hash').$_GET['email']);
	if($key!=$_GET['key']){
		echo "Problème de sécurité!<br/>";
		echo "Merci de prendre contact avec <a href=\"mailto:".ADMINEMAIL."\">".ADMINEMAIL."</a>";
		exit;
	} else {
		echo "Vérification ok<hr/>";
	}
	/*
	 * nofication mail admin
	 */
	$Sujet = "Activation d'un nouveau compte sur  \"".SITE."\"";
	$Destinataire=ADMINEMAIL;
	//echo $Destinataire; exit;
	
	$From  = "From: " .$_GET['email'] ."\n";
	$From .= "MIME-version: 1.0\n";
	$From .= "Content-type: text/html; charset= UTF-8\n";
		
	$Message = "
	
	"	.$_GET['email'] ."

	Vient de confirmer son inscription, voir sur http://" .SITE ."/" .CHEMIN ."/users/?q=" .$_GET['email']
	
	."
	----
	Cet email a été généré par un script automatique
	";
	$Message=nl2br($Message);
	$envoie=mail($Destinataire,$Sujet,$Message,$From);
	if(!$envoie) {
		echo "Problem sending email!";
	}
	
	
}
public function inscriptionok() {
}
public function confirmer() {
	/*
	 * confirm new user registration after function inscription(): todo
	*/
	$this->layout = 'admin';

	if($_GET['email']) {
		$input = $_GET['email'];
		# sanitize the query
		App::import('Sanitize');
		$q = Sanitize::escape($input);
		$options = array(
				"User.email LIKE '" .$q ."'"
		);
		$this->set(array('user' => $this->paginate('User', $options)));

	}

	if (!empty($this->data))
	{
		//			echo "yo"; exit;
		if ($this->User->save($this->data))
		{
			/*
			 * user saved, send an email
			*
			*/
			$Destinataire=$this->data['User']['email'];
			$Sujet = "Vos informations de connexion à \"a magna'!\"";

			$From  = "From: " .ADMINEMAIL ."\n";
			$From .= "MIME-version: 1.0\n";
			$From .= "Content-type: text/html; charset= UTF-8\n";

			$Message = "Bonjour, " .$this->data['User']['email'] ."
				
			Voici vos informations de connexion à \"a magna'!\":
				
			Identifiant (login):     " .$this->data['User']['username'] ."
			Mot de passe (password): " .$this->data['User']['text'] ."
				
			Pour vous enregistrer: http://www.picadametles.ch/amagna/users/login
				
			Nous vous souhaitons un bon accueil à \"a magna'!\"
			----
			Ne pas répondre à cet email, généré par un script automatique
			";
			$Message=nl2br($Message);
			$envoie=mail($Destinataire,$Sujet,$Message,$From);
			if(!$envoie) {
				echo "Problem sending email!";
			}
				
			$this->Session->setFlash(___('the user has been saved', true), 'flash_message');
			$this->redirect(array('action' => 'index'));
		}
		else
		{
			$this->Session->setFlash(___('the user could not be saved. Please, try again.', true), 'flash_error');
		}
	}

}


/*
 * user's function to get a new password etc.
*/

public function passwordreminder() {
	/*
	 * reset & send password to users
	*/
}

public function renvoiemail() {
	/*
	 * resent password
	*/
	$email=$_GET['email'];
	if(!$email) {
		echo "<h1>Merci de fournir votre email!";
		echo '<br /><a href="javascript:history.go(-1)">Retour</a></h1>';
		exit;
	}
	$confirm="SELECT * FROM users WHERE email LIKE '" .$email ."'";
	//echo "<br>" .$confirm ."<br>"; //tests

	//compte demo
	if($email=="testatable@picadametles.ch") {
		error_reporting(0);
		echo "Vous ne pouvez pas vous faire renvoyer un mot de passe pour le compte démo!";
		echo "<br />Votre adresse IP " .$_SERVER["REMOTE_ADDR"] ." a été enregistrée";
		exit;
	}

	$confirm=mysql_query($confirm);
	if(!$confirm) {
		echo "SQL error: " .mysql_error(); exit;
	}
	if(mysql_num_rows($confirm)=="1") { //user email ok
		$login=mysql_result($confirm,0,'username');
		#génère password
		$pass=""; $length=8;
		$vowels = array("a",  "e",  "i",  "o",  "u",  "ae",  "ou",  "io",
				"ea",  "ou",  "ia",  "ai");
		// A List of Consonants and Consonant sounds that we can insert
		// into the password string
		$consonants = array("b",  "c",  "d",  "g",  "h",  "j",  "k",  "l",  "m",
				"n",  "p",  "r",  "s",  "t",  "u",  "v",  "w",
				"tr",  "cr",  "fr",  "dr",  "wr",  "pr",  "th",
				"ch",  "ph",  "st",  "sl",  "cl");
		// For the call to rand(), saves a call to the count() function
		// on each iteration of the for loop
		$vowel_count = count($vowels);
		$consonant_count = count($consonants);
		// From $i .. $length, fill the string with alternating consonant
		// vowel pairs.
		for ($i = 0; $i < $length; ++$i) {
			$pass .= $consonants[rand(0,  $consonant_count - 1)] .
			$vowels[rand(0,  $vowel_count - 1)];
		}
			
		// Since some of our consonants and vowels are more than one
		// character, our string can be longer than $length, use substr()
		// to truncate the string
		$password=substr($pass,  0,  $length);
		//echo "L'utilisateur avec le mail " .$email ." existe, voici son nouveau mdp: " .$password; //tests
		#$hpassword = Security::hash($password);

		//hashed mao123=b997ab87506787144928a87c3040f316bbebb937
		//echo "<br>Hashed password = " .$hpassword ."<br>"; //tests
		#$hpassword = Security::hash("mao123");
		$hash=Configure::read('Security.salt');
		$hpassword=sha1($hash.$password);
		#echo $hpassword; exit;

		$confirm="UPDATE users SET password = '" .$hpassword ."' WHERE email LIKE '" .$email ."'";
		//echo "<br>".$confirm."<br>"; //tests

		$confirm=mysql_query($confirm);
		if(!$confirm) {
			echo "SQL error: " .mysql_error(); exit;
		}
		$textemail="
		Vous - ou quelqu'un se faisant passer pour vous - a demandé à se faire renvoyer à cet email un mot de passe;

		Votre identifiant: " .$login ."

		Votre nouveau mot de passe: " .$password;
		$textemail.='

		Se connecter à "a magna\'!": <a href="http://www.picadametles.ch/amagna/users/login">http://www.picadametles.ch/amagna/users/login</a>

		----
		Message automatique généré par un script
		';
		$textemail=nl2br($textemail);
		$Destinataire = $email;
		$Sujet = "Nouveau mot de passe \"a magna'!\"";

		$From  = "From: webmaster@picadametles.ch\n";
		$From .= "MIME-version: 1.0\n";
		$From .= "Content-type: text/html; charset= UTF-8\n";

		$Message = $textemail;

		$envoie=mail($Destinataire,$Sujet,$Message,$From);
		if(!$envoie) {
			echo "Problem sending email!";
		}

		echo '<meta http-equiv="refresh" content="0;URL=/amagna/users/confirmation">';


	} else { //user email not registered, potential hack
		// Désactiver le rapport d'erreurs
		error_reporting(0);
		#echo phpinfo();
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />";
		echo "L'email " .$email ." n'est pas enregistr&eacute; dans notre base de données, votre adresse IP " .$_SERVER["REMOTE_ADDR"] ." a été enregistrée";
		exit;
	}
}

public function confirmation() {
	/*
	 * //page to redirect after new password
	*/
}

}
