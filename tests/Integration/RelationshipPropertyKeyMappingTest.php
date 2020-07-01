<?php

/*
 * This file is part of the GraphAware Neo4j PHP OGM package.
 *
 * (c) GraphAware Ltd <info@graphaware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GraphAware\Neo4j\OGM\Tests\Integration;

use GraphAware\Neo4j\OGM\Tests\Integration\Models\RelationshipPropertyKeyMapping\Device;
use GraphAware\Neo4j\OGM\Tests\Integration\Models\RelationshipPropertyKeyMapping\Employee;
use GraphAware\Neo4j\OGM\Tests\Integration\Models\RelationshipPropertyKeyMapping\UsesDevice;

class RelationshipPropertyKeyMappingTest extends IntegrationTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->clearDb();
    }

    public function testRelationshipPropertyKeyIsUsedForMapping()
    {
        $employee = new Employee('John Doe');
        $device = new Device('Apple iPhone X');
        $inUseSince = new \DateTime();
        $usesDevice = new UsesDevice($employee, $device, $inUseSince);

        $employee->setDevice($usesDevice);

        $this->em->persist($employee);
        $this->em->persist($usesDevice);
        $this->em->flush();

        $this->assertGraphExist(
            '(a:Employee)-[:USES_DEVICE { in_use_since: ' . $inUseSince->format('U') . '}]-(b:Device)'
        );
    }
}
