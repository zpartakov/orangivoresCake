<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'functions');

/**
 * Commandes Controller
 *
 * @property Commande $Commande
 * @property PaginatorComponent $Paginator
 */
class CommandesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Auth');

	
	
	var $paginate = array(
			'limit' => 100,
			'order' => array(
					'Commande.id' => 'desc' 
			)
	);
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Paginator->settings = $this->paginate;
		$this->Commande->recursive = 0;
		$this->set('commandes', $this->Paginator->paginate());
		//$this->set('commandes', $this->paginate());
		
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
		
		if (!$this->Commande->exists($id)) {
			throw new NotFoundException(__('Invalid commande'));
		}
		$options = array('conditions' => array('Commande.' . $this->Commande->primaryKey => $id));
		$this->set('commande', $this->Commande->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Commande->create();
			if ($this->Commande->save($this->request->data)) {
				$this->Session->setFlash(__('The commande has been saved.'));
				return $this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('The commande could not be saved. Please, try again.'));
			}
		}
		$users = $this->Commande->User->find('list');
		$livraisons = $this->Commande->Livraison->find('list');
		$agrumes = $this->Commande->Agrume->find('list');
		$this->set(compact('users', 'livraisons', 'agrumes'));
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
		
		if (!$this->Commande->exists($id)) {
			throw new NotFoundException(__('Invalid commande'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Commande->save($this->request->data)) {
				$this->Session->setFlash(__('The commande has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The commande could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Commande.' . $this->Commande->primaryKey => $id));
			$this->request->data = $this->Commande->find('first', $options);
		}
		$users = $this->Commande->User->find('list');
		$livraisons = $this->Commande->Livraison->find('list');
		$agrumes = $this->Commande->Agrume->find('list');
		$this->set(compact('users', 'livraisons', 'agrumes'));
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
		
		$this->Commande->id = $id;
		if (!$this->Commande->exists()) {
			throw new NotFoundException(__('Invalid commande'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Commande->delete()) {
			$this->Session->setFlash(__('The commande has been deleted.'));
		} else {
			$this->Session->setFlash(__('The commande could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	/*
	 * csv export see https://github.com/josegonzalez/cakephp-csvview
	 */
	public function export() {
		$data = array(
				array('a', 'b', 'c'),
				array(1, 2, 3),
				array('you', 'and', 'me'),
		);
		
		$data= $this->Commande->Agrume->find('list');
				
		$_serialize = 'data';
	
		$this->viewClass = 'CsvView.Csv';
		$this->set(compact('data', '_serialize'));
	}
	
	
}
