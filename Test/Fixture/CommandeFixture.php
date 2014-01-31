<?php
/**
 * CommandeFixture
 *
 */
class CommandeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12),
		'livraison_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12),
		'agrume_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 12),
		'quant' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '3,1'),
		'paied' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 1),
		'note' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'livraison_id' => 1,
			'agrume_id' => 1,
			'quant' => 1,
			'paied' => 1,
			'note' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);

}
