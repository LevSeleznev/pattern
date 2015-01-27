<?php
interface Book {
	public function getTitle();
	public function getAuthor();
}

interface Adapter {
	public function getTitleAndAuthor();
}

class NewBook implements Book {
	protected $title;
	protected $author;
	
	public function __construct($title, $author) {
		$this->title = $title;
		$this->author = $author;
	}
	
	public function getTitle() {
		return $this->title . ' ( ' . __METHOD__ . ' ) ';
	}
	
	public function getAuthor() {
		return $this->author . ' ( ' . __METHOD__ . ' ) ';
	}
}

class NewAdapter implements Adapter {
	protected $book;
	public function __construct(Book $book) {
		$this->book = $book;
	}
	
	public function getTitleAndAuthor() {
		return $this->book->getTitle() . ' - ' . $this->book->getAuthor() . ' ( ' . __METHOD__ . ' ) ';
	}
}

$book = new NewBook('Мёртвые души', 'Гоголь');
echo $book->getTitle() . '<br />';
echo $book->getAuthor() . '<br />';

$adapter = new NewAdapter(new NewBook('Мёртвые души', 'Гоголь'));
echo $adapter->getTitleAndAuthor();