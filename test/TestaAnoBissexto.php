<?php 
	require_once "../AnoBissexto.php";
	class TestaAnoBissexto extends PHPUnit_Framework_TestCase {

		public function testDeveSerBissextoSeDivisivelPor400() {
			$bissexto = new AnoBissexto();
			$this->assertEquals(true, $bissexto->ehBissexto(2000));
		}

		public function testNaoDeveSerBissextoSeDivisivelPor100ENaoPor400() {
			$bissexto = new AnoBissexto();
			$this->assertEquals(false, $bissexto->ehBissexto(1900));
		}

		public function testDeveSerBissextoSeNaoDivisivelPor100MasDivisivelPor4() {
			$bissexto = new AnoBissexto();
			$this->assertEquals(true, $bissexto->ehBissexto(2004));
		}
	}