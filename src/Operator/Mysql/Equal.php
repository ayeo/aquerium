<?php declare(strict_types=1);

namespace Ayeo\Aquerium\Operator\Mysql;

use Ayeo\Aquerium\Operator\Base\Equal as Base;

class Equal extends Base
{
	public function getOperator(): string
	{
		return '=';
	}
}
