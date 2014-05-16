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
class CsvHelper extends AppHelper {

	var $delimiter = ';';
	var $enclosure = '"';
	var $filename = 'Export.csv';
	var $line = array();
	var $buffer;

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

// CSV
	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
		$this->clear();
	}
	// public function CsvHelper() {
	//     $this->clear();
	// }

	public function clear() {
	    $this->line = array();
	    $this->buffer = fopen('php://temp/maxmemory:'. (5*1024*1024), 'r+');
	}

	public function addField($value) {
	    $this->line[] = $value;
	}

	public function endRow() {
	    $this->addRow($this->line);
	    $this->line = array();
	}

	public function addRow($row) {
	    fputcsv($this->buffer, $row, $this->delimiter, $this->enclosure);
	}

	public function renderHeaders() {
	    header('Content-Type: text/csv');
	    header("Content-type:application/vnd.ms-excel");
	    header("Content-disposition:attachment;filename=".$this->filename);
	}

	public function setFilename($filename) {
	    $this->filename = $filename;
	    if (strtolower(substr($this->filename, -4)) != '.csv') {
	        $this->filename .= '.csv';
	    }
	}

	public function render($outputHeaders = true, $to_encoding = null, $from_encoding ="auto") {
	    if ($outputHeaders) {
	        if (is_string($outputHeaders)) {
	            $this->setFilename($outputHeaders);
	        }
	        $this->renderHeaders();
	    }
	    rewind($this->buffer);
	    $output = stream_get_contents($this->buffer);

	    if ($to_encoding) {
	        $output = mb_convert_encoding($output, $to_encoding, $from_encoding);
	    }
	    return $this->output($output);
	}
}
