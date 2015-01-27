<?php
class Singleton {
	static private $instance = null;
	public $name;

	private function __construct() {}
	private function __clone() {}

	public function echoName() {
		echo $this->name . '<br />';
	}

	static public function getInstance() {
		if(self::$instance === null) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}

$first = Singleton::getInstance();
$second = Singleton::getInstance();
$third = Singleton::getInstance();

$first->name = 'first';
$second->name = 'second';
$third->name = 'third';

$first->echoName();
$second->echoName();
$third->echoName();