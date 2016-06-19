<?php 
	require_once "Avaliador.php";
	class AvaliadorTest extends PHPUnit_Framework_TestCase {
		public function testDeveRetornarOMaiorEOMenor() {
			$u1 = new Usuario("U1");
			$u2 = new Usuario("U2");
			$u3 = new Usuario("U3");

			$leilao = new Leilao("Uma bola de Tênis");
			$leilao->propoe(new Lance($u1, 300));
			$leilao->propoe(new Lance($u2, 200));
			$leilao->propoe(new Lance($u3, 301));

			$leiloeiro = new Avaliador($leilao);

			$menorEsperado = 200;
			$maiorEsperado = 301;
			$this->assertEquals($menorEsperado, $leiloeiro->getMenorLance());
			$this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance());
		}
	}