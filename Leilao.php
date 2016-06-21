<?php
	require_once "Lance.php";
	require_once "Usuario.php";
	class Leilao {

		private $ultimoADarLance;
		private $descricao;
		private $lances;
		
		function __construct($descricao) {
			$this->descricao = $descricao;
			$this->lances = array();
		}

		public function propoe(Lance $lance) {
			if (count($this->lances) == 0 || $this->podeDarLance($lance->getUsuario())) {
				$this->lances[] = $lance;
			}
		}

		public function getDescricao() {
			return $this->descricao;
		}

		public function getLances() {
			return $this->lances;
		}

		private function podeDarLance(Usuario $usuario) {
			return $this->ultimoLanceDado()->getUsuario()->getNome() != $usuario->getNome() 
			&& $this->quantidadeDeLancesDo($usuario) < 5; 
		}

		private function quantidadeDeLancesDo(Usuario $usuario) {
			$total = 0;
			foreach ($this->lances as $lance) {
				if ($lance->getUsuario()->getNome() == $usuario->getNome()) {
					$total++;
				}
			}
			return $total;
		}

		private function ultimoLanceDado() {
			return $this->lances[count($this->lances) - 1];
		}

		public function dobraLanceDo(usuario $usuario) {
			if ($this->pegaUltimoLanceDo($usuario) != null){
				$this->propoe(new Lance($usuario, $this->pegaUltimoLanceDo($usuario)->getValor()*2));
			}
		}

		private function pegaUltimoLanceDo(Usuario $usuario) {
			$ultimo = null;
			foreach ($this->lances as $lance) {
				if ($lance->getUsuario()->getNome() == $usuario->getNome()) {
					$ultimo = $lance;
				}
			}
			return $ultimo;
		}
	}
?>