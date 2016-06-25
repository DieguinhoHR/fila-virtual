<?php

require_once __DIR__ . '/../bootstrap.php';
require_once 'routes.php';

use App\Infrastrutucture\Database\Connectors\{Connector, MysqlConnector};
use App\Core\Domain\User;
use App\Core\Repositories\UserPersistence;

