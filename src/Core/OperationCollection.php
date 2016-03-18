<?php

namespace Rokka\Client\Core;

/**
 * OperationCollection.
 *
 * Represents a collection of operations
 */
class OperationCollection implements \Countable
{
    /**
     * Array of operations.
     *
     * @var array
     */
    private $operations = [];

    /**
     * Constructor.
     *
     * @param array $operations Array of operations
     */
    public function __construct(array $operations)
    {
        $this->operations = $operations;
    }

    /**
     * Return count of operations.
     *
     * @return int
     */
    public function count()
    {
        return count($this->operations);
    }

    /**
     * Return operations.
     *
     * @return array
     */
    public function getOperations()
    {
        return $this->operations;
    }

    /**
     * Create a collection from the JSON data.
     *
     * @param string $jsonString JSON as a string
     *
     * @return OperationCollection
     */
    public static function createFromJsonResponse($jsonString)
    {
        $data = json_decode($jsonString, true);

        $operations = [];

        foreach ($data as $name => $operationData) {
            // Ensuring that the required fields exist.
            $operationData = array_merge(['required' => [], 'properties' => []], $operationData);
            $operations[] = new Operation($name, $operationData['properties'], $operationData['required']);
        }

        return new self($operations);
    }
}
