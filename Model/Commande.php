<?php
App::uses('AppModel', 'Model');
/**
 * Commande Model
 *
 * @property User $User
 * @property Livraison $Livraison
 * @property Agrume $Agrume
 */
class Commande extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Livraison' => array(
			'className' => 'Livraison',
			'foreignKey' => 'livraison_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Agrume' => array(
			'className' => 'Agrume',
			'foreignKey' => 'agrume_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
