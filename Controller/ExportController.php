<?php

App::uses('ExportAppController', 'Export.Controller');

/**
 * Export Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class ExportController extends ExportAppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'Export';

/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
	public $uses = array('Users.User');

/**
 * admin_index
 *
 * @return void
 */
	public function admin_index() {
		$this->set('title_for_layout', 'Export');

		$conditions = array(
			'Role.alias' => 'registered',	// Registered
			'User.status' => true,			// Varified
			);	
		$order = array('User.created DESC');
		$fields = array('User.name','User.email','User.created');
		$users = $this->User->find('all', compact('conditions','order','fields'));

		$this->autoLayout = false;
		Configure::write('debug', 0);

		$this->set(compact('users'));
	}

/**
 * admin_chooser
 *
 * @return void
 */
	public function admin_chooser() {
		$this->set('title_for_layout', 'Chooser Export');
	}

/**
 * index
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout', 'Export');
		$this->set('exportVariable', 'value here');
	}

	public function admin_add() {
	}

	public function admin_rte_export() {
		$notice = 'If editors are not displayed correctly, check that `Ckeditor` plugin is loaded after `Export` plugin.';
		$this->Session->setFlash($notice, 'default', array('class' => 'success'));
	}

}
