<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace EzSystems\EzPlatformRest\Tests\Server\Output\ValueObjectVisitor;

use EzSystems\EzPlatformRest\Tests\Output\ValueObjectVisitorBaseTest;
use EzSystems\EzPlatformRest\Server\Output\ValueObjectVisitor;
use EzSystems\EzPlatformRest\Server\Values\ObjectStateGroupList;
use eZ\Publish\Core\Repository\Values\ObjectState\ObjectStateGroup;

class ObjectStateGroupListTest extends ValueObjectVisitorBaseTest
{
    /**
     * Test the ObjectStateGroupList visitor.
     *
     * @return string
     */
    public function testVisit()
    {
        $visitor = $this->getVisitor();
        $generator = $this->getGenerator();

        $generator->startDocument(null);

        $groupList = new ObjectStateGroupList([]);

        $this->addRouteExpectation('ezpublish_rest_loadObjectStateGroups', [], '/content/objectstategroups');

        $visitor->visit(
            $this->getVisitorMock(),
            $generator,
            $groupList
        );

        $result = $generator->endDocument(null);

        $this->assertNotNull($result);

        return $result;
    }

    /**
     * Test if result contains ObjectStateGroupList element.
     *
     * @param string $result
     *
     * @depends testVisit
     */
    public function testResultContainsObjectStateGroupListElement($result)
    {
        $this->assertXMLTag(
            [
                'tag' => 'ObjectStateGroupList',
            ],
            $result,
            'Invalid <ObjectStateGroupList> element.',
            false
        );
    }

    /**
     * Test if result contains ObjectStateGroupList element attributes.
     *
     * @param string $result
     *
     * @depends testVisit
     */
    public function testResultContainsObjectStateGroupListAttributes($result)
    {
        $this->assertXMLTag(
            [
                'tag' => 'ObjectStateGroupList',
                'attributes' => [
                    'media-type' => 'application/vnd.ez.api.ObjectStateGroupList+xml',
                    'href' => '/content/objectstategroups',
                ],
            ],
            $result,
            'Invalid <ObjectStateGroupList> attributes.',
            false
        );
    }

    /**
     * Test if ObjectStateGroupList visitor visits the children.
     */
    public function testObjectStateGroupListVisitsChildren()
    {
        $visitor = $this->getVisitor();
        $generator = $this->getGenerator();

        $generator->startDocument(null);

        $groupList = new ObjectStateGroupList(
            [
                new ObjectStateGroup(),
                new ObjectStateGroup(),
            ]
        );

        $this->getVisitorMock()->expects($this->exactly(2))
            ->method('visitValueObject')
            ->with($this->isInstanceOf(\eZ\Publish\API\Repository\Values\ObjectState\ObjectStateGroup::class));

        $visitor->visit(
            $this->getVisitorMock(),
            $generator,
            $groupList
        );
    }

    /**
     * Get the ObjectStateGroupList visitor.
     *
     * @return \EzSystems\EzPlatformRest\Server\Output\ValueObjectVisitor\ObjectStateGroupList
     */
    protected function internalGetVisitor()
    {
        return new ValueObjectVisitor\ObjectStateGroupList();
    }
}
