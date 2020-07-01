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

use GraphAware\Neo4j\OGM\Proxy\EntityProxy;
use GraphAware\Neo4j\OGM\Tests\Integration\Models\RelationshipSameLabel\Building;
use GraphAware\Neo4j\OGM\Tests\Integration\Models\RelationshipSameLabel\Room;
use GraphAware\Neo4j\OGM\Tests\Integration\Models\RelationshipSameLabel\Equipment;

/**
 * Class RelationshipSameLabelTest.
 *
 * @group entity-rel-same-label
 */
class RelationshipSameLabelTest extends IntegrationTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->clearDb();

        $this->client->run('
            CREATE (n:Building)
            CREATE (:Room)-[:Located]->(n)
            CREATE (:Room)-[:Located]->(n)
            CREATE (:Equipment)-[:Located]->(n)
            CREATE (:Equipment)-[:Located]->(n)
            CREATE (:Equipment)-[:Located]->(n)');
    }

    public function testCountRelationshipByLabel()
    {
        $buildings = $this->em->getRepository(Building::class)->findAll();
        $this->assertSame(1, count($buildings));
        $building = $buildings[0];
        $this->assertSame(3, count($building->getEquipments()));
        foreach ($building->getEquipments() as $equipment) {
            $this->assertInstanceOf(Equipment::class, $equipment);
        }
        $this->assertSame(2, count($building->getRooms()));
        foreach ($building->getRooms() as $room) {
            $this->assertInstanceOf(Room::class, $room);
        }
    }

}
