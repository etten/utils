<?php

/**
 * Copyright © 2016 Jaroslav Hranička <hranicka@outlook.com>
 */

namespace Etten\Utils;

interface Lock
{

	public function open();

	public function read();

	public function write($s = '');

	public function close();

}
