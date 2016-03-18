<?php

namespace Rokka\Client\Core;

/**
 * SourceImageCollection
 *
 * Represents a collection of source images
 */
class SourceImageCollection implements \Countable
{
    /**
     * Array of source images
     *
     * @var array
     */
    private $sourceImages = [];

    /**
     * Constructor
     *
     * @param array $sourceImages Array of source images
     */
    public function __construct(array $sourceImages)
    {
        $this->sourceImages = $sourceImages;
    }

    /**
     * Return count of source images
     *
     * @return integer
     */
    public function count()
    {
        return count($this->sourceImages);
    }

    /**
     * Return source images
     *
     * @return array
     */
    public function getSourceImages()
    {
        return $this->sourceImages;
    }

    /**
     * Create a collection from the JSON data.
     *
     * @param string $jsonString JSON as a string
     *
     * @return SourceImageCollection
     */
    public static function createFromJsonResponse($jsonString)
    {
        $data = json_decode($jsonString, true);

        $sourceImages = array_map(function ($sourceImage) {
            return SourceImage::createFromJsonResponse($sourceImage, true);
        }, $data['items']);

        return new SourceImageCollection($sourceImages);
    }
}

