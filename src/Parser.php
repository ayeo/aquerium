<?php declare(strict_types=1);

namespace Ayeo\Aquerium;

use Ayeo\Aquerium\Driver\Driver;
use Ayeo\Aquerium\Field\Field;
use Ayeo\Aquerium\Driver\Operator;
use RuntimeException;

class Parser
{
	/** @var Driver */
	private $driver;

	/** @var Field[] */
	private $fields;

	public function __construct(Driver $driver, array $fields)
	{
		//todo: fields may not be empty
		//todo: dont allow to add same field symbol twice - use addField() in loop
		$this->driver = $driver;
		$this->fields = $fields;
	}

	public function parse(array $data, array $map = []): string
	{
		$result = '';
		foreach ($data as $parts) {
			if (is_string($parts)) { //todo: and if it is AND/OR
				$result .= sprintf(' %s ', $parts); //todo: dont allow to end query with operator
			} else {
				@list($field, $operator, $value) = $parts; //index 1 may not be set [[field, equal, value]]
				if (is_string($field)) {
					$field = $map[$field] ?? $field;
					$fieldObject = $this->getField($field);
					$result .= $this->driver->$operator($fieldObject, $value);
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
}
