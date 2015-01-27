<?php
abstract class Header {
	abstract public function bigHeader($arr = null);
	abstract public function smallHeader($arr = null);
}

abstract class Body {
	abstract public function bigBody($arr = null);
	abstract public function smallBody($arr = null);
}

abstract class Footer {
	abstract public function bigFooter($arr = null);
	abstract public function smallFooter($arr = null);
}

class PrintHeader extends Header {
	public function bigHeader($arr = null) {
		if($arr != null) {
			foreach($arr as $key => $a) {
				echo $key . ' - ' . $a;
			}
		}
	}
	public function smallHeader($arr = null) {
		if($arr != null) {
			foreach($arr as $key => $a) {
				echo $key . ' - ' . $a;
			}
		}
	}
}

class PrintBody extends Body {
	public function bigBody($arr = null) {
		if($arr != null) {
			foreach($arr as $key => $a) {
				echo $key . ' - ' . $a;
			}
		}
	}
	public function smallBody($arr = null) {
		if($arr != null) {
			foreach($arr as $key => $a) {
				echo $key . ' - ' . $a;
			}
		}
	}
}

class PrintFooter extends Footer {
	public function bigFooter($arr = null) {
		if($arr != null) {
			foreach($arr as $key => $a) {
				echo $key . ' - ' . $a;
			}
		}
	}
	public function smallFooter($arr = null) {
		if($arr != null) {
			foreach($arr as $key => $a) {
				echo $key . ' - ' . $a;
			}
		}
	}
}

class WebHeader extends Header {
	public function bigHeader($arr = null) {
		if($arr != null) {
			echo 'Шапка на большом экране<br />';
			foreach($arr as $key => $a) {
				echo $key . ' - ' . $a . '<br />';
			}
		}
	}
	public function smallHeader($arr = null) {
		if($arr != null) {
			foreach($arr as $key => $a) {
				echo $key . ' - ' . $a;
			}
		}
	}
}

class WebBody extends Body {
	public function bigBody($arr = null) {
		if($arr != null) {
			echo 'Body на большом экране<br />';
			foreach($arr as $key => $a) {
				echo $key . ' - ' . $a . '<br />';
			}
		}
	}
	public function smallBody($arr = null) {
		if($arr != null) {
			foreach($arr as $key => $a) {
				echo $key . ' - ' . $a;
			}
		}
	}
}

class WebFooter extends Footer {
	public function bigFooter($arr = null) {
		if($arr != null) {
			echo 'Footer на большом экране<br />';
			foreach($arr as $key => $a) {
				echo $key . ' - ' . $a . '<br />';
			}
		}
	}
	public function smallFooter($arr = null) {
		if($arr != null) {
			foreach($arr as $key => $a) {
				echo $key . ' - ' . $a;
			}
		}
	}
}

class Prototype {
	protected $_head;
	protected $_body;
	protected $_footer;
	public function __construct(Header $head, Body $body, Footer $footer) {
		$this->_head = $head;
		$this->_body = $body;
		$this->_footer = $footer;
	}
	
	public function getHead() {
		return clone $this->_head;
	}
	
	public function getBody() {
		return clone $this->_body;
	}
	
	public function getFooter() {
		return clone $this->_footer;
	}
}

$webDocument = new Prototype(new WebHeader(), new WebBody(), new WebFooter());

$head = $webDocument->getHead();
$body = $webDocument->getBody();
$footer = $webDocument->getFooter();

$head->bigHeader(array('background-color' => 'white', 'font-size' => '12px'));
$body->bigBody(array('background-color' => 'red', 'font-size' => '15px'));
$footer->bigFooter(array('background-color' => 'yellow', 'font-size' => '8px'));