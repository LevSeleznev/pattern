<?php
class MyArrayIterator implements Iterator {
	protected $_array = array();
	
	public function __construct(array $array) {
		$this->_array = $array; 
	}
	
	public function current() {
		return current($this->_array);
	}
	
	public function next() {
		next($this->_array);
	}
	
	public function key() {
		return key($this->_array);
	}
	
	 public function valid() {
		return isset($this->_array[$this->key()]);
	}
	
	public function rewind() {
		reset($this->_array);
	}
}

class MyIteratorAggregate implements IteratorAggregate {
	public function getIterator() {
		return new ArrayIterator(array(1, 2, 3, 4));
	}
}

$iterator = new MyArrayIterator(array(3,4,5,6));

var_dump(iterator_to_array($iterator));

foreach ($iterator as $value) {
var_dump($value);
}

echo '<br />';

$iteratorAggregate = new MyIteratorAggregate();
foreach($iteratorAggregate as $value) {
	var_dump($value);
}