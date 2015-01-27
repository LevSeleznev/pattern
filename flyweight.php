<?php
//FlyweightFactory
class FlyweightFactory {
	private $characters = array();
	
	public function getCharacter($key) {
		if(!array_key_exists($key, $this->characters)) {
			switch($key) {
				case 'A':
					$characters[$key] = new CharacterA();
					break;
				case 'B':
					$characters[$key] = new CharacterB();
					break;
				case 'Z':
					$characters[$key] = new CharacterZ();
					break;
			}
		}
		
		return $characters[$key];
	}
}

//Flyweight
abstract class Character {
	protected $symbol;
	protected $width;
	protected $height;
	protected $pointSize;
	abstract public function display($pointSize);
}

class CharacterA extends Character {
	public function __construct() {
		$this->symbol = 'A';
		$this->width = '500px';
		$this->height = '300px';
	}
	public function display($pointSize) {
		$this->pointSize = $pointSize;
		print $this->symbol . ' - ' . $this->pointSize . '<br />';
	}
}

class CharacterB extends Character {
	public function __construct() {
		$this->symbol = 'B';
		$this->width = '300px';
		$this->height = '500px';
	}
	public function display($pointSize) {
		$this->pointSize = $pointSize;
		print $this->symbol . ' - ' . $this->pointSize . '<br />';
	}
}

class CharacterZ extends Character {
	public function __construct() {
		$this->symbol = 'Z';
		$this->width = '600px';
		$this->height = '400px';
	}
	public function display($pointSize) {
		$this->pointSize = $pointSize;
		print $this->symbol . ' - ' . $this->pointSize . '<br />';
	}
}

$symbols = 'AZBBAAZZ';
$symbols_arr = str_split($symbols);

$flyweightFactory = new FlyweightFactory();

$pointSize = 0;
foreach($symbols_arr as $symbol){
	$pointSize++;
	$flyweightFactory->getCharacter($symbol)->display($pointSize);
}