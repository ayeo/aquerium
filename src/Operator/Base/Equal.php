<?php declare(strict_types=1);

namespace Ayeo\Aquerium\Operator\Base;

use Ayeo\Aquerium\Operator\Operator;

abstract class Equal extends Operator
{
	final public function getSlug(): string
	{
		return 'equal';
	}
}
