<?php
abstract class Logger {
	const ERROR = 3;
	const EMAIL = 5;
	const DEBUG = 7;
	
	protected $priority;
	protected $next;
	
	public function __construct($priority) {
		$this->priority = $priority;
	}
	
	public function setNext(Logger $log) {
		$this->next = $log;
		return $log;
	}
	
	public function write($msg, $priority) {
		if($this->priority <= $priority) {
			$this->writeMessage($msg);
		}
		if($this->next != null) {
			$this->next->write($msg, $priority);
		}
	}
	
	protected abstract function writeMessage($msg);
}

class ErrorLogger extends Logger {
	protected function writeMessage($msg) {
		echo "Error message: $msg <br />";
	}
}

class EmailLogger extends Logger {
	protected function writeMessage($msg) {
		echo "Email message: $msg <br />";
	}
}

class DebugLogger extends Logger {
	protected function writeMessage($msg) {
		echo "Debug message: $msg <br />";
	}
}

class ChainOfResponsibility {
	public function run() {
		$logger = new ErrorLogger(Logger::DEBUG);
		$logger1 = $logger->setNext(new EmailLogger(Logger::EMAIL));
		$logger2 = $logger1->setNext(new DebugLogger(Logger::ERROR));

		$logger->write("DEBUG ", Logger::DEBUG);

		$logger->write("NOTICE ", Logger::EMAIL);

		$logger->write("ERROR ", Logger::ERROR);
	}
}

$chain = new ChainOfResponsibility();
$chain->run();