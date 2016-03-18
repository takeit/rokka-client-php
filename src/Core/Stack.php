<?php

namespace Rokka\Client\Core;

/**
 * Class Stack
 *
 * Represents a collection of stack operations for an organization
 */
class Stack
{
    /**
     * @var string Organization name
     */
    public $organization;

    /**
     * @var string Name of the stack
     */
    public $name;

    /**
     * @var \DateTime When this stack was first created
     */
    public $created;

    /**
     * @var StackOperation[] Collection of stack operations that this stack has
     */
    public $stackOperations;

    /**
     * Constructor
     *
     * @param string    $organization    Organization name
     * @param string    $name            Stack name
     * @param array     $stackOperations Collection of stack operations
     * @param \DateTime $created         Created at
     */
    public function __construct($organization, $name, array $stackOperations, \DateTime $created)
    {
        $this->organization = $organization;
        $this->name = $name;
        $this->stackOperations = $stackOperations;
        $this->created = $created;
    }

    /**
     * Create a stack from the JSON data.
     *
     * @param string|array $data    JSON data
     * @param boolean      $isArray If the data provided is already an array
     *
     * @return Stack
     */
    public static function createFromJsonResponse($data, $isArray = false)
    {
        if (!$isArray) {
            $data = json_decode($data, true);
        }

        $stack_operations = array();
        foreach ($data['stack_operations'] as $operation) {
            $stack_operations[] = StackOperation::createFromJsonResponse($operation, true);
        }

        return new Stack(
            $data['organization'],
            $data['name'],
            $stack_operations,
            new \DateTime($data['created'])
        );
    }

    /**
     * Get nanme of organization for url
     *
     * @return string
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Get name of stack for url
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get date of creation for this stack
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Get collection of operations
     *
     * @return StackOperation[]
     */
    public function getStackOperations()
    {
        return $this->stackOperations;
    }

}
