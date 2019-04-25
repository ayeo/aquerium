<?php declare(strict_types=1);

namespace Ayeo\Aquerium;

use Ayeo\Aquerium\Field\Field;
use Ayeo\Aquerium\Operator\Operator;
use RuntimeException;

class Parser
{
	/** @var Operator[] */
	private $operators;

	/** @var Field[] */
	private $fields;

	public function __construct(array $operators, array $fields)
	{
		//todo: neither operator and fields may be empty
		//todo: dont allow to add same field symbol twice (same for operators) - use addField() in loop
		$this->operators = $operators;
		$this->fields = $fields;
	}

	public function parse(array $data): string
	{
		$result = '';
		foreach ($data as $parts) {
			if (is_string($parts)) { //todo: and if it is AND/OR
				$result .= sprintf(' %s ', $parts); //todo: dont allow to end query with operator
			} else {
				list($field, $operator, $value) = $parts;
				if (is_string($field)) {
					$operator = $this->getOperator($operator);
					$fieldObject = $this->getField($field);
					$result .= sprintf(
						'%s%s%s',
						$field,
						$operator->getOperator(),
						$operator->processValue($value, $fieldObject)
					);
				} else {
					$result .= sprintf('(%s)', $this->parse($parts));
				}
			}
		}

		return $result;
	}

	/**
	 * @throws RuntimeException
	 */
	private function getField(string $name): Field
	{
		foreach ($this->fields as $field) {
			if ($field->getName() === $name) {
				return $field;
			}
		}

		throw new RuntimeException('Unknown field');
	}

	/**
	 * @throws RuntimeException
	 */
	private function getOperator(string $symbol): Operator
	{
		foreach ($this->operators as $operator) {
			if ($operator->getSlug() === $symbol) {
				return $operator;
			}
		}

		throw new RuntimeException('Unknown operator');
	}

	//for tests purposes only
	public function getOperators(): array
	{
		return $this->operators;
	}
}
