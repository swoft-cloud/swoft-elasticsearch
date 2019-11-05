<?php declare(strict_types=1);

namespace Swoft\Elasticsearch;

use Swoft\Elasticsearch\Connection\Connection;
use Swoft\Connection\Pool\AbstractPool;
use Swoft\Connection\Pool\Contract\ConnectionInterface;

/**
 * Class Pool
 *
 * @since   2.0
 *
 * @package Swoft\Elasticsearch
 */
class Pool extends AbstractPool
{

    const DEFAULT_POOL = 'elasticsearch.pool';

    /**
     * @var Client
     */
    private $client;

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * createConnection
     *
     * @return ConnectionInterface
     */
    public function createConnection(): ConnectionInterface
    {
        $id = $this->getConnectionId();

        /** @var Connection $connection */
        $connection = bean(Connection::class);
        $connection->setId($id);
        $connection->setPool($this);
        $connection->setLastTime();
        $connection->setClient($this->client);

        $connection->create();

        return $connection;
    }

}