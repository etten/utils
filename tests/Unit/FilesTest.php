<?php

namespace Tests\Unit;

use Etten\Utils;

class FooTest extends \PHPUnit_Framework_TestCase
{

	public function testGetBar()
	{
		if (php_uname('s') === 'Linux') {
			$files = new Utils\Files();
			$path = __DIR__ . '/../temp/' . bin2hex(random_bytes(5));
			$this->assertSame($path, $files->create($path));
			$this->assertSame(0777, fileperms($path) & 0777);
		} else {
			$this->markTestSkipped('Linux-only.');
		}
	}

}
