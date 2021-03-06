<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace EzSystems\EzPlatformRest\Server\Input\Parser\Aggregation;

use eZ\Publish\API\Repository\Values\Content\Query\Aggregation\AbstractTermAggregation;
use eZ\Publish\API\Repository\Values\Content\Query\Aggregation\RawTermAggregation;
use EzSystems\EzPlatformRest\Input\ParsingDispatcher;

final class RawTermAggregationParser extends AbstractTermAggregationParser
{
    protected function getAggregationName(): string
    {
        return 'RawTermAggregation';
    }

    protected function parseAggregation(array $data, ParsingDispatcher $parsingDispatcher): AbstractTermAggregation
    {
        return new RawTermAggregation(
            $data['name'],
            $data['fieldName'],
        );
    }
}
