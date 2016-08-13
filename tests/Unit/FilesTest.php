<?php

namespace Tests\Unit;

use Etten\Utils;

class FilesTest extends \PHPUnit_Framework_TestCase
{

	public function testCreateFile1()
	{
		if (php_uname('s') === 'Linux') {
			$files = new Utils\Files();
			$path = __DIR__ . '/../temp/' . bin2hex(random_bytes(5));
			$this->assertSame($path, $files->createFile($path));
			$this->assertSame(0666, fileperms($path) & 0777);
		} else {
			$this->markTestSkipped('Linux-only.');
		}
	}

	public function testCreateFile2()
	{
		if (php_uname('s') === 'Linux') {
			$files = new Utils\Files();
			$path = __DIR__ . '/../temp/' . bin2hex(random_bytes(5));
			$this->assertSame($path, $files->createFile($path, 0777));
			$this->assertSame(0777, fileperms($path) & 0777);
		} else {
			$this->markTestSkipped('Linux-only.');
		}
	}

	public function testCreateDirectory1()
	{
		if (php_uname('s') === 'Linux') {
			$files = new Utils\Files();
			$path = __DIR__ . '/../temp/' . bin2hex(random_bytes(5));
			$this->assertSame($path, $files->createDirectory($path));
			$this->assertSame(0775, fileperms($path) & 0777);
		} else {
			$this->markTestSkipped('Linux-only.');
		}
	}

}
