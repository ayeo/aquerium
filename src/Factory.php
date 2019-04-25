<?php declare(strict_types=1);

namespace Ayeo\Aquerium;

use Ayeo\Aquerium\Operator\EngineType;

class Factory
{
	/** @var string */
	const BASE = 'Ayeo\Aquerium\Operator';

	/** @var EngineType */
	private $engineType;

	/** @var string[] */
	private $operators = ['Equal'];

	public function __construct(EngineType $engineType)
	{
		$this->engineType = $engineType;
	}

	public function build(array $fields): Parser
	{
		$operators = [];
		foreach ($this->operators as $operator) {
			$className = sprintf('%s\%s\%s', self::BASE, $this->engineType, $operator);
			$operators[] = new $className();
		}

		return new Parser($operators, $fields);
	}
}
