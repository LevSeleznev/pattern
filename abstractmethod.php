<?php
abstract class abstractNode {
	abstract function createNode($node);
} 

class Node extends abstractNode {
	public function __construct() {
		echo get_class($this) . '<br />';
	}
	public function createNode($node) {
		return new Node();
	}
}

class createdNode extends Node {
	public function __construct() {}
	public function createNode($node) {
		switch($node) {
			case 'x':
				return new X();
			case 'y':
				return new Y();
		}
		return parent::createNode($node);
	}
}

class X {
	public function __construct() {
		echo get_class($this) . '<br />';
	}
}
class Y {
	public function __construct() {
		echo get_class($this) . '<br />';
	}
}

$created = new createdNode();
$x = $created->createNode('x');
$y = $created->createNode('y');
$z = $created->createNode('z');