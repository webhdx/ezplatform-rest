<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\EzPlatformRest\Server\Output\ValueObjectVisitor;

use EzSystems\EzPlatformRest\Output\ValueObjectVisitor;
use EzSystems\EzPlatformRest\Output\Generator;
use EzSystems\EzPlatformRest\Output\Visitor;
use eZ\Publish\API\Repository\Values\ObjectState\ObjectStateGroup as ObjectStateGroupValue;

/**
 * ObjectStateGroup value object visitor.
 */
class ObjectStateGroup extends ValueObjectVisitor
{
    /**
     * Visit struct returned by controllers.
     *
     * @param \EzSystems\EzPlatformRest\Output\Visitor $visitor
     * @param \EzSystems\EzPlatformRest\Output\Generator $generator
     * @param \eZ\Publish\API\Repository\Values\ObjectState\ObjectStateGroup $data
     */
    public function visit(Visitor $visitor, Generator $generator, $data)
    {
        $generator->startObjectElement('ObjectStateGroup');
        $visitor->setHeader('Content-Type', $generator->getMediaType('ObjectStateGroup'));
        $visitor->setHeader('Accept-Patch', $generator->getMediaType('ObjectStateGroupUpdate'));
        $this->visitObjectStateGroupAttributes($visitor, $generator, $data);
        $generator->endObjectElement('ObjectStateGroup');
    }

    protected function visitObjectStateGroupAttributes(Visitor $visitor, Generator $generator, ObjectStateGroupValue $data)
    {
        $generator->startAttribute(
            'href',
            $this->router->generate('ezpublish_rest_loadObjectStateGroup', ['objectStateGroupId' => $data->id])
        );
        $generator->endAttribute('href');

        $generator->startValueElement('id', $data->id);
        $generator->endValueElement('id');

        $generator->startValueElement('identifier', $data->identifier);
        $generator->endValueElement('identifier');

        $generator->startValueElement('defaultLanguageCode', $data->defaultLanguageCode);
        $generator->endValueElement('defaultLanguageCode');

        $generator->startValueElement('languageCodes', implode(',', $data->languageCodes));
        $generator->endValueElement('languageCodes');

        $generator->startObjectElement('ObjectStates', 'ObjectStateList');
        $generator->startAttribute(
            'href',
            $this->router->generate('ezpublish_rest_loadObjectStates', ['objectStateGroupId' => $data->id])
        );
        $generator->endAttribute('href');
        $generator->endObjectElement('ObjectStates');

        $this->visitNamesList($generator, $data->getNames());
        $this->visitDescriptionsList($generator, $data->getDescriptions());
    }
}
