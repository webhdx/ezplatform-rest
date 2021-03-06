<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\EzPlatformRest\Server\Values;

use eZ\Publish\API\Repository\Values\Content\Location;
use EzSystems\EzPlatformRest\Value as RestValue;

/**
 * RestLocation view model.
 */
class RestLocation extends RestValue
{
    /**
     * A location.
     *
     * @var \eZ\Publish\API\Repository\Values\Content\Location
     */
    public $location;

    /**
     * Number of children of the location.
     *
     * @var int
     */
    public $childCount;

    /**
     * @param \eZ\Publish\API\Repository\Values\Content\Location $location
     * @param int $childCount
     */
    public function __construct(Location $location, $childCount)
    {
        $this->location = $location;
        $this->childCount = $childCount;
    }
}
