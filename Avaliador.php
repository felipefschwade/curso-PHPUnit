<?php 
	require_once "Lance.php";
	require_once "Leilao.php";
	require_once "Usuario.php";

	class Avaliador {
		
		private $maiorLance = -INF;
		private $menorLance = INF;

		public function avalia(Leilao $leilao) {
			foreach ($leilao->getLances() as $lance) {
				if ($lance->getValor() > $this->maiorLance) {
					$this->maiorLance = $lance->getValor();
				}
				if ($lance->getValor() < $this->menorLance) {
					$this->menorLance = $lance->getValor();
				}
			}
		}
		public function getMenorLance() {
			return $this->menorLance;
		}

		public function getMaiorLance() {
			return $this->maiorLance;
		}

		public function getMediaDosLances(Leilao $leilao) {
			$valorTotal = 0;
			foreach ($leilao->getLances() as $lance) {
				$valorTotal += $lance->getValor(); 
			}
			return $valorTotal/count($leilao->getLances());
		}
	}	
?>