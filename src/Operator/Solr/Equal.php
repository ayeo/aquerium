<?php declare(strict_types=1);

namespace Ayeo\Aquerium\Operator\Solr;

use Ayeo\Aquerium\Field\Field;
use Ayeo\Aquerium\Operator\Base\Equal as Base;

class Equal extends Base
{
	public function processValue(string $value, Field $field): string
	{
		if ($field->quoteValue()) {
			return sprintf('"%s"', $value);
		}

		return parent::processValue($value, $field);
	}

	public function getOperator(): string
	{
		return ':';
	}
}
