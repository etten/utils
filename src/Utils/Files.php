<?php

/**
 * Copyright © 2016 Jaroslav Hranička <hranicka@outlook.com>
 */

namespace Etten\Utils;

use Etten;

class Files
{

	public function createFile(string $path, int $chmod = 0666): string
	{
		if (!is_file($path)) {
			if (!touch($path)) {
				throw new Etten\IOException(sprintf('Unable to create file %s.', $path));
			}

			$this->chmod($path, $chmod);
		}

		return $path;
	}

	public function createDirectory(string $path, int $chmod = 0777): string
	{
		if (!is_dir($path)) {
			// Intentionally @; not atomic.
			if (!@mkdir($path, $chmod, TRUE)) {
				throw new Etten\IOException(sprintf('Unable to create directory %s.', $path));
			}

			$this->chmod($path, $chmod);
		}

		return $path;
	}

	private function chmod(string $path, int $chmod)
	{
		if (!chmod($path, $chmod)) {
			throw new Etten\IOException(sprintf('Unable to chmod directory %s as %s.', $path, $chmod));
		}
	}

}
