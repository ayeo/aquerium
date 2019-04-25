<?php declare(strict_types=1);

namespace Ayeo\Aquerium\Test;

use Ayeo\Aquerium\Operator;
use Ayeo\Aquerium\Parser;
use Ayeo\Aquerium\Field;
use PHPUnit\Framework\TestCase;

class SolrParserTest extends TestCase
{
	/** @var Parser */
	private $parser;

	public function testTheSimplestCase(): void
	{
		$q = [['name', 'equal', 'value']];
		$this->assertEquals('name:"value"', $this->parser->parse($q));
	}

	public function testSimpleCaseWithNumericField(): void
	{
		$q = [['price', 'equal', '100']];
		$this->assertEquals('price:100', $this->parser->parse($q));
	}

	public function testBigAnd(): void
	{
		$q = [['name', 'equal', 'value'], 'OR', ['symbol', 'equal', 'value']];
		$this->assertEquals('name:"value" OR symbol:"value"', $this->parser->parse($q));
	}

	public function testComplexOne(): void
	{
		$q = [[['name', 'equal', 'value'], 'OR', ['symbol', 'equal', 'value']], 'AND', ['price', 'equal', '100']];
		$this->assertEquals(
			'(name:"value" OR symbol:"value") AND price:100',
			$this->parser->parse($q)
		);
	}

	protected function setUp(): void
	{
		$operators = [
			new Operator\Solr\Equal()
		];

		$fields = [
			new Field\Text('name'),
			new Field\Text('symbol'),
			new Field\Numeric('price')
		];

		$this->parser = new Parser($operators, $fields);
	}
}
