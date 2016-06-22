<?php 
	require_once "../Avaliador.php";
	require_once "../CriadorDeLeilao.php";
	class AvaliadorTest extends PHPUnit_Framework_TestCase {

		private $leiloeiro;
		private $criador;

		public function setUp() {
			$this->leiloeiro = new Avaliador();
			$this->criador = new CriadorDeLeilao();
		}

		public function testDeveRetornarOMaiorEOMenor() {
			$u1 = new Usuario("U1");
			$u2 = new Usuario("U2");
			$u3 = new Usuario("U3");

			$leilao = $this->criador->para("Playstation 4")->lance($u1, 300)->lance($u2, 200)->lance($u3, 301)->constroi();

			$this->leiloeiro->avalia($leilao);

			$menorEsperado = 200;
			$maiorEsperado = 301;
			$this->assertEquals($menorEsperado, $this->leiloeiro->getMenorLance(), 0.00001);
			$this->assertEquals($maiorEsperado, $this->leiloeiro->getMaiorLance(), 0.00001);
		}

		public function testDeveRetornarAMediaDosLances() {
			$u1 = new Usuario("U1");
			$u2 = new Usuario("U2");
			$u3 = new Usuario("U3");

			$leilao = $this->criador->para("Uma bola de Tênis")->lance($u1, 100)->lance($u2, 100)->lance($u3, 100)->constroi();

			$this->leiloeiro->avalia($leilao);

			$mediaEsperada = 100;

			$this->assertEquals($mediaEsperada, $this->leiloeiro->getMediaDosLances($leilao), 0.1);
		}

		public function testDeveFuncionarComApenasUmLance() {
			$u1 = new Usuario("U1");

			$leilao = $this->criador->para("Uma bola de Tênis")->lance($u1, 300)->constroi();

			$this->leiloeiro->avalia($leilao);

			$menorEsperado = 300;
			$maiorEsperado = 300;

			$this->assertEquals($menorEsperado, $this->leiloeiro->getMenorLance(), 0.00001);
			$this->assertEquals($maiorEsperado, $this->leiloeiro->getMaiorLance(), 0.00001);	
		}

		public function testDeveAceitarLancesEmOrdemAleatoria() {
			$u1 = new Usuario("U1");
			$u2 = new Usuario("U2");
			$u3 = new Usuario("U3");
			$u4 = new Usuario("U4");
			$u5 = new Usuario("U5");
			$u6 = new Usuario("U6");

			$leilao = $this->criador->para("Uma bola de Tênis")->lance($u1, 300)->lance($u2, 200)->lance($u3, 454)->lance($u4, 190)->lance($u5, 147)->lance($u6, 302)->constroi();
	
			$this->leiloeiro->avalia($leilao);


			$menorEsperado = 147;
			$maiorEsperado = 454;
			$this->assertEquals($menorEsperado, $this->leiloeiro->getMenorLance(), 0.00001);
			$this->assertEquals($maiorEsperado, $this->leiloeiro->getMaiorLance(), 0.00001);
		}

		public function testDeveAceitarLancesEmOrdemDecrescente() {
			$u1 = new Usuario("U1");
			$u2 = new Usuario("U2");
			$u3 = new Usuario("U3");

			$leilao = $this->criador->para("Uma bola de Tênis")->lance($u1, 300)->lance($u2, 200)->lance($u3, 100)->constroi();

			$this->leiloeiro->avalia($leilao);

			$menorEsperado = 100;
			$maiorEsperado = 300;
			$this->assertEquals($menorEsperado, $this->leiloeiro->getMenorLance(), 0.00001);
			$this->assertEquals($maiorEsperado, $this->leiloeiro->getMaiorLance(), 0.00001);
		}

		public function testDevePegarOs3Maiores() {
			$u1 = new Usuario("U1");
			$u2 = new Usuario("U2");
			$u3 = new Usuario("U3");
			$u4 = new Usuario("U4");
			$u5 = new Usuario("U5");

			$leilao = $this->criador->para("Uma bola de Tênis")->lance($u1, 300)->lance($u2, 200)->lance($u3, 100)->lance($u4, 400)->lance($u5, 500)->constroi();

			$this->leiloeiro->pegaOsMaioresNo($leilao);

			$this->assertEquals(500, $this->leiloeiro->getTresMaiores()[0]->getValor(), 0.00001);
			$this->assertEquals(400, $this->leiloeiro->getTresMaiores()[1]->getValor(), 0.00001);
			$this->assertEquals(300, $this->leiloeiro->getTresMaiores()[2]->getValor(), 0.00001);
		}

		public function testDeveAceitarSomente2Lances() {
			$u1 = new Usuario("U1");
			$u2 = new Usuario("U2");

			$leilao = $this->criador->para("Uma bola de Tênis")->lance($u1, 300)->lance($u2, 200)->constroi();

			$this->leiloeiro->pegaOsMaioresNo($leilao);

			$this->assertEquals(300, $this->leiloeiro->getTresMaiores()[0]->getValor(), 0.00001);
			$this->assertEquals(200, $this->leiloeiro->getTresMaiores()[1]->getValor(), 0.00001);
		}

		public function testDeveRetornarListaVaziaCasoNaoHajaLances() {

			$leilao = $this->criador->para("Uma bola de Tênis")->constroi();

			$this->leiloeiro->pegaOsMaioresNo($leilao);

			$this->assertEquals(0, count($this->leiloeiro->getTresMaiores()), 0.00001);
		}
	}
