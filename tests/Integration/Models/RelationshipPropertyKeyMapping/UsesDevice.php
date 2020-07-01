<?php

/*
 * This file is part of the GraphAware Neo4j PHP OGM package.
 *
 * (c) GraphAware Ltd <info@graphaware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GraphAware\Neo4j\OGM\Tests\Integration\Models\RelationshipPropertyKeyMapping;

use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * Class UsesDevice.
 *
 * @OGM\RelationshipEntity(type="USES_DEVICE")
 */
class UsesDevice
{
    /**
     * @OGM\GraphId()
     *
     * @var int
     */
    protected $id;

    /**
     * @OGM\StartNode(targetEntity="Employee")
     *
     * @var Employee
     */
    protected $employee;

    /**
     * @OGM\EndNode(targetEntity="Device")
     *
     * @var Device
     */
    protected $device;

    /**
     * @OGM\Property(type="int", key="in_use_since")
     * @OGM\Convert(type="datetime", options={"format":"timestamp"})
     *
     * @var \DateTime
     */
    protected $inUseSince;

    /**
     * UsesDevice constructor.
     *
     * @param Employee  $employee
     * @param Device    $device
     * @param \DateTime $inUseSince
     */
    public function __construct(Employee $employee, Device $device, \DateTime $inUseSince)
    {
        $this->employee = $employee;
        $this->device = $device;
        $this->inUseSince = $inUseSince;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Employee
     */
    public function getEmployee()
    {
        return $this->employee;
    }

    /**
     * @param Employee $employee
     *
     * @return UsesDevice
     */
    public function setEmployee($employee)
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * @return Device
     */
    public function getDevice()
    {
        return $this->device;
    }

    /**
     * @param Device $device
     *
     * @return UsesDevice
     */
    public function setDevice($device)
    {
        $this->device = $device;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getInUseSince()
    {
        return $this->inUseSince;
    }

    /**
     * @param \DateTime $inUseSince
     *
     * @return UsesDevice
     */
    public function setInUseSince($inUseSince)
    {
        $this->inUseSince = $inUseSince;

        return $this;
    }
}
