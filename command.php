<?php
class Lamp {
	public function turnOn() {
		echo "Лампа включена<br />";
	}
	
	public function turnOff() {
		echo "Лампа выключена<br />";
	}
}

interface Command {
	public function execute();
}

class TurnOnCommand implements Command {
	private $lamp;

	public function __construct(Lamp $lamp) {
		$this->lamp = $lamp;
	}
	
	public function execute() {
		$this->lamp->turnOn();
	}
}

class TurnOffCommand implements Command {
	private $lamp;

	public function __construct(Lamp $lamp) {
		$this->lamp = $lamp;
	}
	
	public function execute() {
		$this->lamp->turnOff();
	}
}

//Используем фабричный метод для инициализации объектов:
/*class LampCommandFactory {
	public function registry(Lamp $lamp, $type) {
		if($type == 'ON') {
			return new TurnOnCommand($lamp);
		}
		if($type == 'OFF') {
			return new TurnOffCommand($lamp);
		}
		return new Exception('Undefined type: ' . $type);
	}
}*/

//Используем регистр для инициализации объектов:
class LampCommandRegistry {
	private $registry = array();
	
	public function add(Command $command, $type) {
		$this->registry[$type] = $command;
	}
	
	public function get($type) {
		if(!isset($this->registry[$type])) {
			throw new Exception('Not exist ' . $type);
		}
		
		return $this->registry[$type];
	}
}

//Используем фабричный метод для инициализации объектов:
/*$lamp = new Lamp();
$factory = new LampCommandFactory();
$factory->registry($lamp, 'ON')->execute();*/

//Используем регистр для инициализации объектов:
$lamp = new Lamp();
$registry = new LampCommandRegistry();
$registry->add(new TurnOnCommand($lamp), 'ON');
$registry->get('ON')->execute();