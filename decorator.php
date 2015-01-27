<?php
abstract class Component {
	abstract function operation();
}

class ConcreteComponent extends Component {
	public function operation() {
		return "I'm ConcreteComponent!<br />";
	}
}

class Decorator extends Component {
	protected $_component;
	
	public function __construct(Component $component) {
		$this->_component = $component;
	}
	
	public function getComponent() {
		return $this->_component;
	}
	
	public function operation() {
		return $this->getComponent()->operation();
	}
}

class ComponentDecoratorA extends Decorator {
	public function operation() {
		return "<span style='color:green;'>" . $this->getComponent()->operation() . "</span>";
	}
}

class ComponentDecoratorB extends Decorator {
	public function operation() {
		return "<span style='color:red;'>" . $this->getComponent()->operation() . "</span>";
	}
}

$concrete = new ConcreteComponent;
$a = new ComponentDecoratorA($concrete);
$b = new ComponentDecoratorB($concrete);

echo $concrete->operation() . '<br />';
echo $a->operation() . '<br />';
echo $b->operation() . '<br />';