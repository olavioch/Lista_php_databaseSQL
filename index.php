<?php
	declare(strict_types=1);
	class Produtos{
		/**
		*@var string
		*/
		private $pdo=null;
		public function  __construct(string $host, string $banco, string $user, string $pass){
			try{
			$this->pdo = new PDO('mysql:host='. $host .'; dbname='. $banco, $user, $pass);
			}catch(Exception $e){
				echo $e->getMessage();
			}
		}
		public function lista(){
			$sql = 'select * from produtos';
			echo '<h3>Produtos</h3>';
			foreach($this->pdo->query($sql) as $key => $value){
				echo 'id: '. $value['id'] .' nome ' . $value['nome'] . '<hr>';
			}			
		}
		public function insert(string $nome){
			$sql = 'insert into produtos(nome) values(?)';
			$prepare = $this->pdo->prepare($sql);
			$prepare->bindParam(1, $nome);
			$prepare->execute();
			echo $prepare->rowCount();
		}
		public function update(string $nome, string $id){
			$sql = 'update produtos set nome = ? where id = ?';
			$prepare = $this->pdo->prepare($sql);
			$prepare->bindParam(1, $nome);
			$prepare->bindParam(2, $id);
			$prepare->execute();
			echo $prepare->rowCount();
		}
		public function deletar(string $id){
			$sql = 'delete from produtos where id = ?';
			$prepare= $this->pdo->prepare($sql);
			$prepare->bindParam(1, $id);
			$prepare->execute();
			echo $prepare->rowCount();
		}
	}
$database = new Produtos('127.0.0.1', 'exemplo', 'root', 'power123');
$database->deletar('3');
$database->insert('mais um item adicionado');
$database->lista();
?>