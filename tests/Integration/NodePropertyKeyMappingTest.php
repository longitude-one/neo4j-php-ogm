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

use GraphAware\Neo4j\OGM\Tests\Integration\Models\NodePropertyKeyMapping\Employee;

class NodePropertyKeyMappingTest extends IntegrationTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->clearDb();
    }

    public function testNodePropertyKeyIsUsedForMapping()
    {
        $hiredOn = new \DateTime();
        $employee = new Employee('John Doe', $hiredOn);

        $this->em->persist($employee);
        $this->em->flush();

        $this->assertGraphExist('(b:Employee {hired_on:' . $hiredOn->format('U') . '})');
    }
}
