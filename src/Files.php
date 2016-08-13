<?php

/**
 * Copyright © 2016 Jaroslav Hranička <hranicka@outlook.com>
 */

namespace Etten\Utils;

class Files
{

	/**
	 * Creates a file with ordinary permissions and a given chmod.
	 * @param string $path
	 * @param int $chmod
	 * @return string Created file path.
	 */
	public function create(string $path, int $chmod = 0666)
	{
		if (!is_file($path)) {
			touch($path); // ensures ordinary file permissions
			chmod($path, $chmod); // allow rwxrxrwx for all users
		}

		return $path;
	}

}
