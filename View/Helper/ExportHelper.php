<?php
App::uses('AppHelper', 'View/Helper');
/**
 * Export Helper
 *
 * An export hook helper for demonstrating hook system.
 *
 * @category Helper
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class ExportHelper extends AppHelper {

/**
 * Other helpers used by this helper
 *
 * @var array
 * @access public
 */
	public $helpers = array(
		'Html',
		'Croogo.Layout',
	);


/**
 * beforeRender
 *
 */
	public function beforeRender($viewFile) {

		$link = $this->_View->Croogo->adminAction(
			__d('croogo', 'New User'),
			array('action' => 'add'),
			array('button' => 'success')
		);

		$link .= $this->_View->Croogo->adminAction(
			__d('croogo', 'Export'),
			array('plugin' => 'export', 'controller' => 'export', 'action' => 'index'),
			array('button' => 'primary', 'target' => '_blank')
		);

		$this->_View->Blocks->concat('actions', $link);
	}

}
