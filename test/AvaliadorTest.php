<?php 
	require_once "../Avaliador.php";
	class AvaliadorTest extends PHPUnit_Framework_TestCase {
		public function testDeveRetornarOMaiorEOMenor() {
			$u1 = new Usuario("U1");
			$u2 = new Usuario("U2");
			$u3 = new Usuario("U3");

			$leilao = new Leilao("Uma bola de Tênis");
			$leilao->propoe(new Lance($u1, 300));
			$leilao->propoe(new Lance($u2, 200));
			$leilao->propoe(new Lance($u3, 301));

			$leiloeiro = new Avaliador();
			$leiloeiro->avalia($leilao);


			$menorEsperado = 200;
			$maiorEsperado = 301;
			$this->assertEquals($menorEsperado, $leiloeiro->getMenorLance(), 0.00001);
			$this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance(), 0.00001);
		}

		public function testDeveRetornarAMediaDosLances() {
			$u1 = new Usuario("U1");
			$u2 = new Usuario("U2");
			$u3 = new Usuario("U3");

			$leilao = new Leilao("Uma bola de Tênis");
			$leilao->propoe(new Lance($u1, 100));
			$leilao->propoe(new Lance($u2, 100));
			$leilao->propoe(new Lance($u3, 100));

			$leiloeiro = new Avaliador();
			$leiloeiro->avalia($leilao);

			$mediaEsperada = 100;

			$this->assertEquals($mediaEsperada, $leiloeiro->getMediaDosLances($leilao), 0.1);
		}

		public function testDeveFuncionarComApenasUmLance() {
			$u1 = new Usuario("U1");

			$leilao = new Leilao("Uma bola de Tênis");
			$leilao->propoe(new Lance($u1, 300));

			$leiloeiro = new Avaliador();
			$leiloeiro->avalia($leilao);

			$menorEsperado = 300;
			$maiorEsperado = 300;

			$this->assertEquals($menorEsperado, $leiloeiro->getMenorLance(), 0.00001);
			$this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance(), 0.00001);	
		}
	}
