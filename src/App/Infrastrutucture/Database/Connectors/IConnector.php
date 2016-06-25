<?php

namespace App\Infrastrutucture\Database\Connectors;

interface IConnector
{
    /**
     * Establish a database connection.
     *
     * @param  array  $config
     * @return \PDO
     */
    public function connect(array $config);
}