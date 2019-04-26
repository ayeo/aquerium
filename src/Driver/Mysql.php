<?php declare(strict_types=1);

namespace Ayeo\Aquerium\Driver;

use Ayeo\Aquerium\Field\Field;

final class Mysql extends Driver
{
	function equal(Field $field, string $value): string
	{
		return sprintf('%s=%s', $field->getName(), $value);
	}
}
