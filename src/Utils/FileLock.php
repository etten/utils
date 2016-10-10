<?php

/**
 * Copyright © 2016 Jaroslav Hranička <hranicka@outlook.com>
 */

namespace Etten\Utils;

use Etten\LockException;

class FileLock implements Lock
{

	/** @var string */
	private $filePath;

	/** @var resource|null */
	private $filePointer;

	public function __construct(string $filePath)
	{
		$this->filePath = $filePath;
	}

	public function open()
	{
		if ($this->filePointer) {
			return;
		}

		$this->filePointer = fopen($this->filePath, 'a+');
		if (!flock($this->filePointer, LOCK_EX | LOCK_NB)) {
			throw new LockException('Locked.');
		}
	}

	public function read()
	{
		if (!$this->filePointer) {
			throw new \RuntimeException('Lock is not opened.');
		}

		// reset pointer to the begging
		fseek($this->filePointer, 0);
		return fgets($this->filePointer);
	}

	public function write($s = '')
	{
		if (!$this->filePointer) {
			throw new \RuntimeException('Lock is not opened.');
		}

		ftruncate($this->filePointer, 0);
		fputs($this->filePointer, $s);
	}

	public function close()
	{
		fclose($this->filePointer);
		$this->filePointer = NULL;
	}

}
