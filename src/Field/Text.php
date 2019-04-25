<?php declare(strict_types=1);

namespace Ayeo\Aquerium\Field;

class Text extends Field
{
	public function quoteValue(): bool
	{
		return true;
	}
}
