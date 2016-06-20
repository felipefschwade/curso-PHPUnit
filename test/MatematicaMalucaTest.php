<?php
	require_once "../MatematicaMaluca.php";
	class MatematicaMalucaTest extends PHPUnit_Framework_TestCase {

		public function testDeveMultiplicarNumeroPor4() {
			$matMal = new MatematicaMaluca();
			$resultado = $matMal->contaMaluca(40);

			$esperado = 160;

			$this->assertEquals($esperado, $resultado, 0.000001);
		}

		public function testDeveMultiplicarNumeroPor3() {
			$matMal = new MatematicaMaluca();
			$resultado = $matMal->contaMaluca(20);

			$esperado = 60;

			$this->assertEquals($esperado, $resultado, 0.000001);
		}

		public function testDeveMultiplicarNumeroPor2() {
			$matMal = new MatematicaMaluca();
			$resultado = $matMal->contaMaluca(10);

			$esperado = 20;

			$this->assertEquals($esperado, $resultado, 0.000001);
		}
	}