<?php
abstract class View {
	protected $impl;
	
	public function __construct($impl) {
		//Здесь нужно использовать абстрактную фабрику
		switch($impl) {
			case 'html':
				$this->impl = new Html();
				break;
			case 'xml':
				$this->impl = new Xml();
				break;
			default:
				throw new Exception('Такой формат не поддерживается');
		}
	}
	
	public function getImplementation() {
		return $this->impl;
	}
	
	public function content($text) {
		return $this->impl->content($text);
	}
	
	public function line() {
		return $this->impl->line();
	}
	
	public function printResult()
    {
        print $this->getImplementation()->getResult();
    }
}

class ViewText extends View {
	public function drawText($text) {
		$this->impl->content($text);
	}
}

class ViewTextLine extends View {
	public function drawText($text) {
		$this->impl->line();
		$this->impl->content($text);
		$this->impl->line();
	}
}

abstract class Format {
	abstract public function content($text);
	abstract public function line();
	abstract public function getResult();
	
	abstract protected function appendResult($result);
}

class Html extends Format {
	protected $result;
	public function content($text) {
		$this->appendResult('HTML: ' . $text);
	}
	public function line() {
		$this->appendResult('<hr />');
	}
	public function getResult() {
		echo $this->result;
	}
	protected function appendResult($result) {
		$this->result .= $result;
	}
}

class Xml extends Format {
	protected $result;
	public function content($text) {
		$this->appendResult('XML: ' . $text);
	}
	public function line() {
		$this->appendResult('<hr />');
	}
	public function getResult() {
		echo $this->result;
	}
	protected function appendResult($result) {
		$this->result .= $result;
	}
}

$textLine = new ViewTextLine('html');
$textLine->drawText('Паттерн проекстирования - Мост');
$impl = $textLine->getImplementation();
$impl->getResult();

$textLine2 = new ViewText('xml');
$textLine2->drawText('Паттерн проекстирования - Мост');
$impl2 = $textLine2->getImplementation();
$impl2->getResult();