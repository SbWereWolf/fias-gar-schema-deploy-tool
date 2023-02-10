<?php

declare(strict_types=1);

namespace SbWereWolf\FiasGarSchemaDeploy\Cli;

use PDO;
use Psr\Log\LoggerInterface;
use SbWereWolf\FiasGarSchemaDeploy\DataStorage\Printery;
use SbWereWolf\FiasGarSchemaDeploy\DataStorage\SqlExecutor;

class ExecuteSqlFromTemplatesCommand
{
    private SqlExecutor $executor;
    private Printery $printery;

    /**
     * @param PDO $connection
     * @param LoggerInterface $logger
     * @param string $templatePath
     */
    public function __construct(
        PDO $connection,
        LoggerInterface $logger,
        string $templatePath,
    ) {
        $this->executor = new  SqlExecutor($connection, $logger);
        $this->printery = new Printery($templatePath, $logger,);
    }

    /**
     * @param array $templatesKits
     * @param string $templateName
     * @param int $maxSuffix
     * @param bool $runForEmptySuffix
     * @param int $offset
     * @return void
     */
    public function run(
        array $templatesKits,
        string $templateName,
        int $maxSuffix = 0,
        bool $runForEmptySuffix = false,
        int $offset = 0,
    ): void {
        foreach (
            $this->printery->makePrintouts(
                $templatesKits,
                $templateName,
                $maxSuffix,
                $runForEmptySuffix,
                $offset,
            ) as $sql
        ) {
            $this->executor->executeSql($sql);
        }
    }
}