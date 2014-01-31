<?php
App::uses('AppModel', 'Model');
/**
 * Groupe Model
 *
 * @property User $User
 */
class Groupe extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'lib';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'lib' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'groupe_id',
				'dependent' => false,
				
			'conditions' => '',
			'fields' => '',
			'order' => 'username'
		)
	);
}
