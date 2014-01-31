<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'functions');
/**
 * Agrumes Controller
 *
 * @property Agrume $Agrume
 * @property PaginatorComponent $Paginator
 */
class AgrumesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Auth');

	var $paginate = array(
			'limit' => 100,
			'order' => array(
					'Agrume.lib' => 'desc'
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
		
		$this->Agrume->recursive = 0;
		$this->set('Agrumes', $this->Paginator->paginate());
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
		
		if (!$this->Agrume->exists($id)) {
			throw new NotFoundException(__('Invalid  agrume'));
		}
		$options = array('conditions' => array('Agrume.' . $this->Agrume->primaryKey => $id));
		$this->set('Agrume', $this->Agrume->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		eject_non_admin();
		
		if ($this->request->is('post')) {
			$this->Agrume->create();
			if ($this->Agrume->save($this->request->data)) {
				$this->Session->setFlash(__('The  agrume has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The  agrume could not be saved. Please, try again.'));
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
		
		if (!$this->Agrume->exists($id)) {
			throw new NotFoundException(__('Invalid  agrume'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Agrume->save($this->request->data)) {
				$this->Session->setFlash(__('The  agrume has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The  agrume could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Agrume.' . $this->Agrume->primaryKey => $id));
			$this->request->data = $this->Agrume->find('first', $options);
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
		
		$this->Agrume->id = $id;
		if (!$this->Agrume->exists()) {
			throw new NotFoundException(__('Invalid  agrume'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Agrume->delete()) {
			$this->Session->setFlash(__('The  agrume has been deleted.'));
		} else {
			$this->Session->setFlash(__('The  agrume could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
