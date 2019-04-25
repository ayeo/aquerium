<?php declare(strict_types=1);

namespace Ayeo\Aquerium\Operator;

class EngineType
{
	/** @var string */
	private $type;

	private function __construct(string $type)
	{
		$this->type = $type;
	}

	static public function solr(): EngineType
	{
		return new EngineType('Solr');
	}

	static public function mysql(): EngineType
	{
		return new EngineType('Mysql');
	}

	public function __toString(): string
	{
		return $this->type;
	}
}
