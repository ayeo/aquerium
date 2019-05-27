<?php declare(strict_types=1);

namespace Ayeo\Aquerium\Driver;

use Ayeo\Aquerium\Field\Field;

final class Solr extends Driver
{
    private const MIN_NUMBER_DIFF = 0.001;
    
	public function equal(Field $field, string $value): string
	{
		if ($field->quoteValue()) {
			$value = sprintf('"%s"', $value);
		}

		return sprintf('%s:%s', $field->getName(), $value);
	}
    
    public function greaterThan(Field $field, string $value): string
    {
        if ($field->quoteValue()) {
            $value = sprintf('"%s"', $value);
        }
        
        // https://wiki.apache.org/solr/SolrQuerySyntax#Differences_From_Lucene_Query_Parser
        $greaterThanValue = $value + self::MIN_NUMBER_DIFF;
        
        return sprintf('%s:[%s TO *]', $field->getName(), $greaterThanValue);
    }
}
