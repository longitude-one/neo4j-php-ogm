<?php

/*
 * This file is part of the GraphAware Neo4j PHP OGM package.
 *
 * (c) GraphAware Ltd <info@graphaware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GraphAware\Neo4j\OGM;

use Doctrine\Common\EventManager;
use Doctrine\Common\Persistence\ObjectManager;
use GraphAware\Neo4j\OGM\Hydrator\EntityHydrator;
use GraphAware\Neo4j\OGM\Metadata\NodeEntityMetadata;
use GraphAware\Neo4j\OGM\Persisters\BasicEntityPersister;
use GraphAware\Neo4j\OGM\Proxy\ProxyFactory;

interface EntityManagerInterface extends ObjectManager
{
    /**
     * @param string            $host
     * @param null|string       $cacheDir
     * @param null|EventManager $eventManager
     *
     * @return EntityManagerInterface
     */
    public static function create($host, $cacheDir = null, EventManager $eventManager = null);

    /**
     * @return EventManager
     */
    public function getEventManager();

    /**
     * @return \GraphAware\Neo4j\OGM\UnitOfWork
     */
    public function getUnitOfWork();

    /**
     * @return \GraphAware\Neo4j\Client\Client
     */
    public function getDatabaseDriver();

    /**
     * @param string $class
     *
     * @return \GraphAware\Neo4j\OGM\Metadata\QueryResultMapper
     */
    public function getResultMappingMetadata($class);

    /**
     * @param $class
     *
     * @return \GraphAware\Neo4j\OGM\Metadata\NodeEntityMetadata
     */
    public function getClassMetadataFor($class);

    /**
     * @param string $class
     *
     * @throws \Exception
     *
     * @return \GraphAware\Neo4j\OGM\Metadata\RelationshipEntityMetadata
     */
    public function getRelationshipEntityMetadata($class);

    /**
     * @param string $class
     *
     * @return \GraphAware\Neo4j\OGM\Repository\BaseRepository
     */
    public function getRepository($class);

    /**
     * @return string
     */
    public function getProxyDirectory();

    /**
     * @param NodeEntityMetadata $entityMetadata
     *
     * @return ProxyFactory
     */
    public function getProxyFactory(NodeEntityMetadata $entityMetadata);

    /**
     * @param string $className
     *
     * @return EntityHydrator
     */
    public function getEntityHydrator($className);

    /**
     * @param string $className
     *
     * @return BasicEntityPersister
     */
    public function getEntityPersister($className);

    /**
     * @param string $cql
     *
     * @return Query
     */
    public function createQuery($cql = '');

    /**
     * @param string $name
     * @param string $classname
     *
     * @return void
     */
    public function registerPropertyConverter($name, $classname);

    public function getAnnotationDriver();
}
