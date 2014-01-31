<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'functions');
/**
 * NewsletterMails Controller
 *
 * @property NewsletterMail $NewsletterMail
 * @property PaginatorComponent $Paginator
 */
class NewsletterMailsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Auth','Paginator');
		
	var $paginate = array(
			'limit' => 100,
			'order' => array(
					'NewsletterMail.id' => 'desc'
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
		$this->NewsletterMail->recursive = 0;
		$options = array(
				"order id desc"
		);
		$this->set('NewsletterMails', $this->Paginator->paginate());		
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		eject_non_admin();
		
		if (!$this->NewsletterMail->exists($id)) {
			throw new NotFoundException(__('Invalid  newsletter mail'));
		}
		$options = array('conditions' => array('NewsletterMail.' . $this->NewsletterMail->primaryKey => $id));
		$this->set('NewsletterMail', $this->NewsletterMail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	

	public function add() {
		eject_non_admin();
		
		if ($this->request->is('post')) {
			//print_r($this->request->data); exit;
			//echo $this->request->data['test']; exit;
			$Sujet=$this->request->data['NewsletterMail']['subject'];
			$Sujet=addslashes($Sujet);
			$Message=$this->request->data['NewsletterMail']['content'];
			$Message=nl2br($Message);
			$Message=stripslashes($Message);
			//$Destinataire='fradeff@akademia.ch'; //tests
			$Destinataire='aguardiola@bluewin.ch';
			if($this->request->data['test']=='on'){

	
				$From  = "From: " .$this->request->data['NewsletterMail']['from'] ."<" 
				.$this->request->data['NewsletterMail']['from_email'] .">\n";
				$From .= "MIME-version: 1.0\n";
				$From .= "Content-type: text/html; charset= UTF-8\n";
					
				$envoie=mail($Destinataire,$Sujet,$Message,$From);
				if(!$envoie) {
					echo "Problem sending email!";
				}
				echo "test sended to :" .$Destinataire;
				
			} else {
				echo "save and send";
				
				App::uses('ConnectionManager', 'Model');
				$dataSource = ConnectionManager::getDataSource('default');
				$username = $dataSource->config['login'];
				mysql_connect($dataSource->config['host'], $dataSource->config['login'], $dataSource->config['password']);
				$sql="USE ".$dataSource->config['database'];
				$sql=mysql_query($sql);
				if(!$sql) {
					echo "<br>mysql error:<br>". mysql_error(); exit;
				}
				$sql="SELECT uEmail FROM Users ORDER BY uEmail";
				if(!$sql) {
					echo "<br>mysql error:<br>". mysql_error(); exit;
				}
				$sql=mysql_query($sql);
				
				$i=0;
				while($i<mysql_num_rows($sql)) {
					echo mysql_result($sql,$i,'uEmail');
					$Destinataire=mysql_result($sql,$i,'uEmail');
						
					$From  = "From: " .$this->request->data['NewsletterMail']['from'] ."<"
					.$this->request->data['NewsletterMail']['from_email'] .">\n";
					$From .= "MIME-version: 1.0\n";
					$From .= "Content-type: text/html; charset= UTF-8\n";
						
					$envoie=mail($Destinataire,$Sujet,$Message,$From);
					if(!$envoie) {
						echo "Problem sending email!";
					}
					echo "test sended to :" .$Destinataire;
					echo "<br>";
					$i++;
				}
				$this->NewsletterMail->create();
				//$this->request->data['NewsletterMail']['content']=htmlentities($this->request->data['NewsletterMail']['content']);
				if ($this->NewsletterMail->save($this->request->data)) {
					return $this->flash(__('The  newsletter mail has been saved.'), array('action' => 'index'));
				}
			}
			
			//exit;

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
		eject_non_admin();
		
		if (!$this->NewsletterMail->exists($id)) {
			throw new NotFoundException(__('Invalid  newsletter mail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->NewsletterMail->save($this->request->data)) {
				return $this->flash(__('The  newsletter mail has been saved.'), array('action' => 'index'));
			}
		} else {
			$options = array('conditions' => array('NewsletterMail.' . $this->NewsletterMail->primaryKey => $id));
			$this->request->data = $this->NewsletterMail->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		eject_non_admin();
		
		$this->NewsletterMail->id = $id;
		if (!$this->NewsletterMail->exists()) {
			throw new NotFoundException(__('Invalid  newsletter mail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->NewsletterMail->delete()) {
			return $this->flash(__('The  newsletter mail has been deleted.'), array('action' => 'index'));
		} else {
			return $this->flash(__('The  newsletter mail could not be deleted. Please, try again.'), array('action' => 'index'));
		}
	}}
