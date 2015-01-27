<?php
class ComponentException extends Exception {}

abstract class Component {
	protected $_children = array();
	
	abstract function addChild(Component $component);
	abstract function getChild($index);
	abstract function removeChild($index);
	abstract function operation();
	abstract function getChildren();
}

class Composite extends Component {
	public function addChild(Component $component) {
		$this->_children[] = $component;
	}
	
	public function getChild($index) {
		if(isset($this->_children[$index])) {
			return $this->_children[$index];
		}
		throw new ComponentException("Нет элемента с таким индексом");
	}
	
	public function removeChild($index) {
		if(isset($this->_children[$index])) {
			unset($this->_children[$index]);
		} else {
			throw new ComponentException("Нет элемента с таким индексом");
		}
	}
	
	public function operation()
    {
        print "I am composite. I have " . count($this -> getChildren()) . " children\n";
        
        foreach($this->getChildren() as $child)
        {
            $child->operation();
        }
    }
	
	public function getChildren() {
		return $this->_children;
	}
}

class Leaf extends Component
{
    public function addChild(Component $Component)
    {
        throw new ComponentException("I can't append child to myself");
    }

    public function getChild($index)
    {
        throw new ComponentException("Child not exists");
    }

    public function operation()
    {
        print "I am leaf\n";
    }

    public function removeChild($index)
    {
        throw new ComponentException("Child not exists");
    }
    
    public function getChildren()
    {
        return array();
    }
}

$composite = new Composite();
$composite2 = new Composite();
$leaf = new Leaf();
$leaf2 = new Leaf();
$leaf3 = new Leaf();
$composite->addChild($leaf);
$composite->addChild($leaf2);
$composite->addChild($composite2);
$composite2->addChild($leaf3);
$composite->operation();