<?php

namespace Rokka\Client;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;

/**
 * Base Client class.
 */
abstract class Base
{
    const DEFAULT_API_BASE_URL = 'https://api.rokka.io';
    const DEFAULT_API_VERSION = 1;

    const API_KEY_HEADER = 'Api-Key';
    const API_VERSION_HEADER = 'Api-Version';

    /**
     * Client to access Rokka.
     *
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var int
     */
    private $apiVersion = self::DEFAULT_API_VERSION;

    /**
     * Rokka credentials.
     *
     * @var array
     */
    private $credentials = [
        'key' => '',
        'secret' => '',
    ];

    /**
     * Constructor.
     *
     * @param ClientInterface $client Client instance
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Set the credentials.
     *
     * @param string $key    API key
     * @param string $secret API secret
     */
    public function setCredentials($key, $secret)
    {
        $this->credentials = ['key' => $key, 'secret' => $secret];
    }

    /**
     * Call the API rokka endpoint.
     *
     * @param string $method           HTTP method to use
     * @param string $path             Path on the API
     * @param array  $options          Request options
     * @param bool   $needsCredentials True if credentials are needed
     *
     * @return Response
     */
    protected function call($method, $path, array $options = [], $needsCredentials = true)
    {
        $options['headers'][self::API_VERSION_HEADER] = $this->apiVersion;

        if ($needsCredentials) {
            $options['headers'][self::API_KEY_HEADER] = $this->credentials['key'];
        }

        return $this->client->request($method, $path, $options);
    }
}
