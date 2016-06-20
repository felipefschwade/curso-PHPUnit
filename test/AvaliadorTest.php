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

		public function testDeveAceitarLancesEmOrdemAleatoria() {
			$u1 = new Usuario("U1");
			$u2 = new Usuario("U2");
			$u3 = new Usuario("U3");
			$u4 = new Usuario("U4");
			$u5 = new Usuario("U5");
			$u6 = new Usuario("U6");

			$leilao = new Leilao("Uma bola de Tênis");
			$leilao->propoe(new Lance($u1, 300));
			$leilao->propoe(new Lance($u2, 200));
			$leilao->propoe(new Lance($u3, 454));
			$leilao->propoe(new Lance($u4, 190));
			$leilao->propoe(new Lance($u5, 147));
			$leilao->propoe(new Lance($u6, 302));

			$leiloeiro = new Avaliador();
			$leiloeiro->avalia($leilao);


			$menorEsperado = 147;
			$maiorEsperado = 454;
			$this->assertEquals($menorEsperado, $leiloeiro->getMenorLance(), 0.00001);
			$this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance(), 0.00001);
		}

		public function testDeveAceitarLancesEmOrdemDecrescente() {
			$u1 = new Usuario("U1");
			$u2 = new Usuario("U2");
			$u3 = new Usuario("U3");

			$leilao = new Leilao("Uma bola de Tênis");
			$leilao->propoe(new Lance($u1, 300));
			$leilao->propoe(new Lance($u2, 200));
			$leilao->propoe(new Lance($u3, 100));

			$leiloeiro = new Avaliador();
			$leiloeiro->avalia($leilao);


			$menorEsperado = 100;
			$maiorEsperado = 300;
			$this->assertEquals($menorEsperado, $leiloeiro->getMenorLance(), 0.00001);
			$this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance(), 0.00001);
		}

		public function testDevePegarOs3Maiores() {
			$u1 = new Usuario("U1");
			$u2 = new Usuario("U2");
			$u3 = new Usuario("U3");
			$u4 = new Usuario("U4");
			$u5 = new Usuario("U5");

			$leilao = new Leilao("Uma bola de Tênis");
			$leilao->propoe(new Lance($u1, 300));
			$leilao->propoe(new Lance($u2, 200));
			$leilao->propoe(new Lance($u3, 100));
			$leilao->propoe(new Lance($u4, 400));
			$leilao->propoe(new Lance($u5, 500));

			$leiloeiro = new Avaliador();
			$leiloeiro->pegaOsMaioresNo($leilao);


			$this->assertEquals(500, $leiloeiro->getTresMaiores()[0]->getValor(), 0.00001);
			$this->assertEquals(400, $leiloeiro->getTresMaiores()[1]->getValor(), 0.00001);
			$this->assertEquals(300, $leiloeiro->getTresMaiores()[2]->getValor(), 0.00001);
		}

		public function testDeveAceitarSomente2Lances() {
			$u1 = new Usuario("U1");
			$u2 = new Usuario("U2");

			$leilao = new Leilao("Uma bola de Tênis");
			$leilao->propoe(new Lance($u1, 300));
			$leilao->propoe(new Lance($u2, 200));

			$leiloeiro = new Avaliador();
			$leiloeiro->pegaOsMaioresNo($leilao);


			$this->assertEquals(300, $leiloeiro->getTresMaiores()[0]->getValor(), 0.00001);
			$this->assertEquals(200, $leiloeiro->getTresMaiores()[1]->getValor(), 0.00001);
		}

		public function testDeveRetornarListaVaziaCasoNaoHajaLances() {

			$leilao = new Leilao("Uma bola de Tênis");

			$leiloeiro = new Avaliador();
			$leiloeiro->pegaOsMaioresNo($leilao);

			$this->assertEquals(0, count($leiloeiro->getTresMaiores()), 0.00001);
		}
	}
