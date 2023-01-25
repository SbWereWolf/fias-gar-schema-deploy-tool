<?php

declare(strict_types=1);

namespace SbWereWolf\FiasGarSchemaDeploy\Cli;

use PDO;
use Psr\Log\LoggerInterface;
use SbWereWolf\FiasGarSchemaDeploy\DataStorage\Printery;

class SqlRunnerWithoutSuffixesCommand extends SqlExecutor
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
    ) {
        foreach (
            $this->printery->makePrintouts(
                $templatesKits,
                $templateName,
            ) as $sql
        ) {
            $this->executeSql($sql);
        }
    }
}