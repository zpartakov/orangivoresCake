<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'functions');
/**
 * Groupes Controller
 *
 * @property Groupe $Groupe
 * @property PaginatorComponent $Paginator
 */
class GroupesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Auth', 'Paginator');
	
	var $paginate = array(
			'limit' => 100,
			'order' => array(
					'Groupe.lib' => 'asc'
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

		$this->Groupe->recursive = 0;
		$this->set('groupes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Groupe->exists($id)) {
			throw new NotFoundException(__('Invalid groupe'));
		}
		$options = array('conditions' => array('Groupe.' . $this->Groupe->primaryKey => $id));
		$this->set('groupe', $this->Groupe->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		eject_non_admin();
		
		if ($this->request->is('post')) {
			$this->Groupe->create();
			if ($this->Groupe->save($this->request->data)) {
				$this->Session->setFlash(__('The groupe has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The groupe could not be saved. Please, try again.'));
			}
		}
		$users = $this->Groupe->User->find('list');
		$this->set(compact('users'));
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
		
		if (!$this->Groupe->exists($id)) {
			throw new NotFoundException(__('Invalid groupe'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Groupe->save($this->request->data)) {
				$this->Session->setFlash(__('The groupe has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The groupe could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Groupe.' . $this->Groupe->primaryKey => $id));
			$this->request->data = $this->Groupe->find('first', $options);
		}
		$users = $this->Groupe->User->find('list');
		$this->set(compact('users'));
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
		
		$this->Groupe->id = $id;
		if (!$this->Groupe->exists()) {
			throw new NotFoundException(__('Invalid groupe'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Groupe->delete()) {
			$this->Session->setFlash(__('The groupe has been deleted.'));
		} else {
			$this->Session->setFlash(__('The groupe could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
