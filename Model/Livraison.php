<?php
App::uses('AppModel', 'Model');
/**
 * Livraison Model
 *
 * @property Commande $Commande
 */
class Livraison extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'date';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Commande' => array(
			'className' => 'Commande',
			'foreignKey' => 'livraison_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
