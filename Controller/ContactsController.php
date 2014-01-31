<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'functions');
/**
 * Contacts Controller
 *
 * @property Contact $Contact
 * @property PaginatorComponent $Paginator
 */
class ContactsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Auth', 'Paginator');
	
	function beforeFilter() {
		$this->Auth->allow('add');
	}
	
	var $paginate = array(
			'limit' => 100,
			'order' => array(
					'Contact.id' => 'desc'
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
		
		$this->Contact->recursive = 0;
		$this->set('contacts', $this->Paginator->paginate());
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
		
		if (!$this->Contact->exists($id)) {
			throw new NotFoundException(__('Invalid contact'));
		}
		$options = array('conditions' => array('Contact.' . $this->Contact->primaryKey => $id));
		$this->set('contact', $this->Contact->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
public function add() {
	if ($this->request->is('post')) {
		$this->Contact->create();
		if ($this->Contact->save($this->request->data)) {
/*
 * send email notification
*/
$corps="
nom: ".$this->data['Contact']['nom'] ."
prenom: ".$this->data['Contact']['prenom'] ."
nom: ".$this->data['Contact']['adresse'] ."
adresse: ".$this->data['Contact']['code_postal'] ."
commune: ".$this->data['Contact']['commune'] ."
telephone: ".$this->data['Contact']['telephone'] ."
natel: ".$this->data['Contact']['natel'] ."
email: ".$this->data['Contact']['email'] ."
message: ".$this->data['Contact']['message'] ."
";
				
$Message = "Nouveau message de: " .$this->data['Contact']['email'] ."

".$corps ."
	
Pour voir: http://".SERVERNAME.CHEMIN ."/contacts/view/" .$this->Contact->getLastInsertId() ."
----
Ne pas répondre à cet email
";

App::uses('CakeEmail', 'Network/Email');
$Email = new CakeEmail();
$Email->from($this->data['Contact']['email']);
$Email->to(ADMINEMAIL);
$Email->subject("Nouveau message ".SITE);
$Email->send($Message);
				return $this->redirect(array('controller'=>'Articles', 'action' => 'vue/3'));
			} else {
				$this->Session->setFlash(__('Message non envoyé. Merci d\'essayer à nouveau.'));
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
		eject_non_admin();
		
		if (!$this->Contact->exists($id)) {
			throw new NotFoundException(__('Invalid contact'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Contact->save($this->request->data)) {
				$this->Session->setFlash(__('The contact has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The contact could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Contact.' . $this->Contact->primaryKey => $id));
			$this->request->data = $this->Contact->find('first', $options);
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
		
		$this->Contact->id = $id;
		if (!$this->Contact->exists()) {
			throw new NotFoundException(__('Invalid contact'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Contact->delete()) {
			$this->Session->setFlash(__('The contact has been deleted.'));
		} else {
			$this->Session->setFlash(__('The contact could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
