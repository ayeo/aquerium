<?php declare(strict_types=1);

namespace Ayeo\Aquerium\Test;

use Ayeo\Aquerium\Factory;
use Ayeo\Aquerium\Operator\EngineType;
use Ayeo\Aquerium\Operator\Solr\Equal;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
	public function testCreatingSolr(): void
	{
		$factory = new Factory(EngineType::solr());

		$fields = [];
		$parser = $factory->build($fields);

		$this->assertEquals(
			[new Equal()],
			$parser->getOperators()
		);
	}
}
