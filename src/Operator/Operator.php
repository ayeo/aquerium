<?php declare(strict_types=1);

namespace Ayeo\Aquerium\Operator;

use Ayeo\Aquerium\Field\Field;

abstract class Operator
{
	abstract public function getSlug(): string;
	abstract public function getOperator(): string;

	public function processValue(string $value, Field $field): string
	{
		return $value;
	}
}
