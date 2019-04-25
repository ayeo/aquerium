<?php declare(strict_types=1);

namespace Ayeo\Aquerium\Field;

abstract class Field
{
	/** @var string */
	private $symbol;

	final public function __construct(string $symbol)
	{
		$this->symbol = $symbol;
	}

	public function quoteValue(): bool
	{
		return false;
	}

	public function getName(): string
	{
		return $this->symbol;
	}
}
