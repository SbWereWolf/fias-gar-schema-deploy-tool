<?php

declare(strict_types=1);

namespace SbWereWolf\FiasGarSchemaDeploy\Cli;

use PDO;
use Psr\Log\LoggerInterface;
use SbWereWolf\FiasGarSchemaDeploy\DataStorage\Printery;

class SqlRunnerWithSuffixesCommand extends SqlExecutor
{
    public function __construct(
        PDO $connection,
        LoggerInterface $logger,
        string $templatePath,
    ) {
        parent::__construct($connection, $logger);
        $this->printery = new Printery(
            $templatePath,
            $logger,
        );
    }

    public function run(
        array $templatesKits,
        string $templateName,
        bool $runForEmptySuffix,
        int $maxSuffix,
        int $offset,
    ) {
        foreach (
            $this->printery->makePrintouts(
                $templatesKits,
                $templateName,
                $maxSuffix,
                $runForEmptySuffix,
                $offset,
            ) as $sql
        ) {
            $this->executeSql($sql);
        }
    }
}