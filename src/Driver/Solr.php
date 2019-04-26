<?php declare(strict_types=1);

namespace Ayeo\Aquerium\Driver;

use Ayeo\Aquerium\Field\Field;

final class Solr extends Driver
{
	public function equal(Field $field, string $value): string
	{
		if ($field->quoteValue()) {
			$value = sprintf('"%s"', $value);
		}

		return sprintf('%s:%s', $field->getName(), $value);
	}
}
