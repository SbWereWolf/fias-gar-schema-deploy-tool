<?php

declare(strict_types=1);

namespace SbWereWolf\FiasGarSchemaDeploy\DataStorage;

use JsonSerializable;
use PDO;
use Psr\Log\LoggerInterface;
use SbWereWolf\JsonSerializable\JsonSerializeTrait;

/** Класс для выполнения произвольного запроса к СУБД */
class SqlExecutor implements JsonSerializable
{
    use JsonSerializeTrait;

    private LoggerInterface $logger;
    private PDO $connection;

    public function __construct(
        PDO $connection,
        LoggerInterface $logger,
    ) {
        $this->connection = $connection;
        $this->logger = $logger;
    }

    public function executeSql(string $sql): bool
    {
        $isSuccess = $this->connection->exec($sql) !== false;

        $executionResult = $isSuccess ? 'success' : 'failure';
        $message =
            "SQL script was executed with $executionResult";

        $this->logger->info($message);

        return $isSuccess;
    }
}