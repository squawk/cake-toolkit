<?php
/**
 * Exponential view.
 *
 * PHP 5
 *
 * Cake Toolkit (http://caketoolkit.org)
 * Copyright 2012, James Watts (http://github.com/jameswatts)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2012, James Watts (http://github.com/jameswatts)
 * @link          http://caketoolkit.org Cake Toolkit
 * @package       Ctk.View.Benchmark.Ctk
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('CtkView', 'Ctk.View');

/**
 * Exponential view.
 *
 * @package       Ctk.View.Benchmark.Ctk
 */
class ExponentialView extends CtkView {

/**
 * An array of names of element factories to include.
 *
 * @var mixed A single name as a string or a list of names as an array.
 */
	public $factories = 'Ctk.Xml';

/**
 * The MIME-type of the output content.
 *
 * @var string The MIME-type to use.
 */
	public $contentType = 'text/xml';

/**
 * The parent nodes used for the recursive node creation.
 *
 * @var array The parent node references.
 */
	public $parents = null;

/**
 * The child nodes created for the parent nodes.
 *
 * @var array The child node references.
 */
	public $children = null;

/**
 * The increment used to track the exponential increase.
 *
 * @var int The current increment.
 */
	public $increment = 1;

/**
 * Defines the object-oriented structure of the view.
 */
	public function build() {
		$this->parents = array($this);
		for ($i = 0; $i < $this->count; $i++) {
			$this->recursiveNode();
			$this->increment++;
		}
		unset($this->parents, $this->children, $this->increment);
	}

/**
 * Recursive helper method used to generate the nodes.
 */
	public function recursiveNode() {
		$this->children = array();
		for ($k = 0; $k < count($this->parents); $k++) {
			for ($j = 0; $j < $this->increment; $j++) {
				$child = $this->Xml->Node();
				$this->parents[$k]->add($child);
				$this->children[] = $child;
				unset($child);
			}
		}
		$this->parents = $this->children;
	}
}

