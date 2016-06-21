<?php 
	require_once "../Leilao.php";
	class LeilaoTest extends PHPUnit_Framework_TestCase {
		
		public function testNaoDeveAceitarDoisLancesSeguidosDoMesmoUsuario() {
			
			$leilao = new Leilao("Um notebook");
			$u1 = new Usuario("Paulo");
			$u2 = new Usuario("Pedro");

			$leilao->propoe(new Lance($u1, 300));
			$leilao->propoe(new Lance($u2, 200));
			//Deve ser ignorado
			$leilao->propoe(new Lance($u2, 350));

			$this->assertEquals(2, count($leilao->getLances()));
			$this->assertEquals(200, $leilao->getLances()[count($leilao->getLances()) - 1]->getValor());
			
		}

		public function testNaoDeveAceitarMaisQue5LancesDoMesmoUsuario() {

			$leilao = new Leilao("Um notebook");
			$u1 = new Usuario("Paulo");
			$u2 = new Usuario("Pedro");

			$leilao->propoe(new Lance($u1, 100));
			$leilao->propoe(new Lance($u2, 200));
			$leilao->propoe(new Lance($u1, 300));
			$leilao->propoe(new Lance($u2, 400));
			$leilao->propoe(new Lance($u1, 500));
			$leilao->propoe(new Lance($u2, 600));
			$leilao->propoe(new Lance($u1, 700));
			$leilao->propoe(new Lance($u2, 800));
			$leilao->propoe(new Lance($u1, 900));
			$leilao->propoe(new Lance($u2, 1000));
			//Deve ser Ignorado
			$leilao->propoe(new Lance($u1, 1100));

			$this->assertEquals(10, count($leilao->getLances()));
			$this->assertEquals(1000, $leilao->getLances()[count($leilao->getLances()) - 1]->getValor());
		}

		public function testDeveDobrarOLanceAnterior() {
			$leilao = new Leilao("Um notebook");
			$u1 = new Usuario("Paulo");
			$u2 = new Usuario("Pedro");

			$leilao->propoe(new Lance($u1, 100));
			$leilao->propoe(new Lance($u2, 200));
			$leilao->dobraLanceDo($u1);

			$this->assertEquals(3, count($leilao->getLances()));
			$this->assertEquals(200, $leilao->getLances()[count($leilao->getLances()) - 1]->getValor());
		}

		public function testNaoDeveDobrarCasoNaoHajaLanceAnterior() {
			$leilao = new Leilao("Um notebook");
			$u1 = new Usuario("Paulo");
			$u2 = new Usuario("Pedro");

			$leilao->propoe(new Lance($u2, 100));

			$leilao->dobraLanceDo($u1);

			$this->assertEquals(1, count($leilao->getLances()));
			$this->assertEquals(100, $leilao->getLances()[count($leilao->getLances()) - 1]->getValor());
		}

		public function testNaoDeveDobrarCasoOLanceAnteriorDoUsuarioSejaOUltimoLance() {
			$leilao = new Leilao("Um notebook");
			$u1 = new Usuario("Paulo");
			$u2 = new Usuario("Pedro");

			$leilao->propoe(new Lance($u2, 100));
			$leilao->propoe(new Lance($u1, 300));

			$leilao->dobraLanceDo($u1);

			$this->assertEquals(2, count($leilao->getLances()));
			$this->assertEquals(300, $leilao->getLances()[count($leilao->getLances()) - 1]->getValor());
		}

		public function testeNaoDeveDobrarCasoOUsuarioJaTenhaMaisQue5Lances() {

			$leilao = new Leilao("Um notebook");
			$u1 = new Usuario("Paulo");
			$u2 = new Usuario("Pedro");

			$leilao->propoe(new Lance($u1, 100));
			$leilao->propoe(new Lance($u2, 200));
			$leilao->propoe(new Lance($u1, 300));
			$leilao->propoe(new Lance($u2, 400));
			$leilao->propoe(new Lance($u1, 500));
			$leilao->propoe(new Lance($u2, 600));
			$leilao->propoe(new Lance($u1, 700));
			$leilao->propoe(new Lance($u2, 800));
			$leilao->propoe(new Lance($u1, 900));
			$leilao->propoe(new Lance($u2, 1000));
			//Deve ser Ignorado
			$leilao->dobraLanceDo($u1, 1100);

			$this->assertEquals(10, count($leilao->getLances()));
			$this->assertEquals(1000, $leilao->getLances()[count($leilao->getLances()) - 1]->getValor());
		}
	}