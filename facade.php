<?php
class Bank {
	public function openTransaction() {
		echo 'Bank открыл транзакцию<br />';
	}
	public function closeTransaction() {
		echo 'Bank закрыл транзакцию<br />';
	}
	public function transferMoney($transfer) {
		echo "С банковского счёта списано $transfer рублей<br />";
	}
}

class Client {
	public function openTransaction() {
		echo 'Client открыл транзакцию<br />';
	}
	public function closeTransaction() {
		echo 'Client закрыл транзакцию<br />';
	}
	public function transferMoney($transfer) {
		echo "На счёт клиента зачислено $transfer рублей<br />";
	}
}

class Log {
	public function logTransaction($message) {
		echo "message-log: $message<br />";
	}
}

class Facade {
	public function transfer($amount) {
		$log = new Log();
		$client = new Client();
		$bank = new Bank();
		
		$bank->openTransaction();
		$client->openTransaction();
		$log->logTransaction('Транзакции открыты');
		$bank->transferMoney($amount);
		$client->transferMoney($amount);
		$log->logTransaction('Деньги переведены');
		$bank->closeTransaction();
		$client->closeTransaction();
		$log->logTransaction('Транзакции закрыты');
	}
}

$facade = new Facade();
$facade->transfer(1000);