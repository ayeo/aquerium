<?php declare(strict_types=1);

namespace Ayeo\Aquerium\Driver;

use Ayeo\Aquerium\Field\Field;

abstract class Driver
{
	abstract function equal(Field $field, string $value): string;
	
	abstract function greaterThan(Field $field, string $value): string;
}
