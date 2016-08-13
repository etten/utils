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

			if (!chmod($path, $chmod)) {
				throw new Etten\IOException(sprintf('Unable to chmod file %s as $chmod.', $path, $chmod));
			}
		}

		return $path;
	}

	public function createDirectory(string $path, int $chmod = 0775): string
	{
		if (!is_dir($path) && !@mkdir($path, $chmod, TRUE)) { // intentionally @; not atomic
			throw new Etten\IOException(sprintf('Unable to create directory %s.', $path));
		}

		return $path;
	}

}
