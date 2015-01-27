<?php
interface Tank {}
interface Ak {}
interface Tt {}

class RussianTank implements Tank {
	public function __construct () {
		echo get_class($this) . '<br />';
	}
}
class RussianAk implements Ak {
	public function __construct () {
		echo get_class($this) . '<br />';
	}
}
class RussianTt implements Tt {
	public function __construct () {
		echo get_class($this) . '<br />';
	}
}
class UsaTank implements Tank {
	public function __construct () {
		echo get_class($this) . '<br />';
	}
}
class UsaAk implements Ak {
	public function __construct () {
		echo get_class($this) . '<br />';
	}
}
class UsaTt implements Tt {
	public function __construct () {
		echo get_class($this) . '<br />';
	}
}

abstract class AbstractFactory {
	abstract public function createTank();
	abstract public function createAk();
	abstract public function createTt();
}

class RussianArmy extends AbstractFactory {
	public function createTank() {
		return new RussianTank();
	}
	
	public function createAk() {
		return new RussianAk();
	}
	
	public function createTt() {
		return new RussianTt();
	}	
}

class UsaArmy extends AbstractFactory {
	public function createTank() {
		return new UsaTank();
	}
	
	public function createAk() {
		return new UsaAk();
	}
	
	public function createTt() {
		return new UsaTt();
	}	
}

$russianArmy = new RussianArmy();
$usaArmy = new UsaArmy();

$russianArmy->createTank();
$usaArmy->createTt();
$russianArmy->createAk();
$usaArmy->createTank();