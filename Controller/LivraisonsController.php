<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'functions');

/**
 * Livraisons Controller
 *
 * @property Livraison $Livraison
 * @property PaginatorComponent $Paginator
 */
class LivraisonsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Auth', 'Paginator');
	
	var $paginate = array(
			'limit' => 100,
			'order' => array(
					'Livraison.id' => 'desc'
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
		$this->Livraison->recursive = 0;
		$this->set('livraisons', $this->Paginator->paginate());
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
		
		if (!$this->Livraison->exists($id)) {
			throw new NotFoundException(__('Invalid livraison'));
		}
		$options = array('conditions' => array('Livraison.' . $this->Livraison->primaryKey => $id));
		$this->set('livraison', $this->Livraison->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		eject_non_admin();
		
		if ($this->request->is('post')) {
			$this->Livraison->create();
			if ($this->Livraison->save($this->request->data)) {
				$this->Session->setFlash(__('The livraison has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The livraison could not be saved. Please, try again.'));
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
		
		if (!$this->Livraison->exists($id)) {
			throw new NotFoundException(__('Invalid livraison'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Livraison->save($this->request->data)) {
				$this->Session->setFlash(__('The livraison has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The livraison could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Livraison.' . $this->Livraison->primaryKey => $id));
			$this->request->data = $this->Livraison->find('first', $options);
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
		
		$this->Livraison->id = $id;
		if (!$this->Livraison->exists()) {
			throw new NotFoundException(__('Invalid livraison'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Livraison->delete()) {
			$this->Session->setFlash(__('The livraison has been deleted.'));
		} else {
			$this->Session->setFlash(__('The livraison could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
