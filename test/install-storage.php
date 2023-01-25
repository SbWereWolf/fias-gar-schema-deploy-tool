<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\LogRecord;
use SbWereWolf\BatchFileScripting\Configuration\EnvReader;
use SbWereWolf\BatchFileScripting\Convertation\DurationPrinter;
use SbWereWolf\FiasGarSchemaDeploy\Cli\SqlRunnerWithoutSuffixesCommand;
use SbWereWolf\FiasGarSchemaDeploy\Cli\SqlRunnerWithSuffixesCommand;

$startMoment = hrtime(true);

$message = 'Script is starting';
echo $message . PHP_EOL;

$pathParts = [__DIR__, '..', 'vendor', 'autoload.php',];
$path = implode(DIRECTORY_SEPARATOR, $pathParts);
require_once($path);

$logger = new Logger('common');

$logsPath = [
    __DIR__,
    'logs',
    pathinfo(__FILE__, PATHINFO_FILENAME) . '-' . time() . '.log',
];
$path = implode(DIRECTORY_SEPARATOR, $logsPath);

$writeHandler = new StreamHandler($path);
$logger->pushHandler($writeHandler);

$logger->pushProcessor(function ($record) {
    /** @var LogRecord $record */
    echo "{$record->datetime} {$record->message}" . PHP_EOL;

    return $record;
});

$logger->notice($message);

$configurationPath = [__DIR__, 'pdo.env',];
$path = implode(DIRECTORY_SEPARATOR, $configurationPath);
(new EnvReader($path))->defineConstants();

$connection = (new PDO(
    constant('DSN'),
    constant('LOGIN'),
    constant('PASSWORD'),
));
$schema = constant('SCHEMA');
$connection->exec("SET search_path TO {$schema}");

$logger->notice("Starting create tables");

$parts = [__DIR__, 'template',];
$templatePath = implode(DIRECTORY_SEPARATOR, $parts);
$command = new SqlRunnerWithoutSuffixesCommand(
    $connection,
    $logger,
    $templatePath,
);

$tablesList = [
    'ADDHOUSETYPES',
    'ADDR_OBJ_DIVISION',
    'ADDR_OBJ_PARAMS',
    'ADDRESSOBJECTS',
    'ADDRESSOBJECTTYPES',
    'ADM_HIERARCHY',
    'APARTMENTS',
    'APARTMENTS_PARAMS',
    'APARTMENTTYPES',
    'CARPLACES',
    'CARPLACES_PARAMS',
    'CHANGE_HISTORY',
    'HOUSES',
    'HOUSES_PARAMS',
    'HOUSETYPES',
    'MUN_HIERARCHY',
    'NDOCKINDS',
    'NDOCTYPES',
    'NORMDOCS',
    'OBJECTLEVELS',
    'OPERATIONTYPES',
    'PARAMTYPES',
    'REESTR_OBJECTS',
    'ROOMS',
    'ROOMS_PARAMS',
    'ROOMTYPES',
    'STEADS',
    'STEADS_PARAMS',
];
$command->run(
    $tablesList,
    'create-table.php',
);

$logger->notice("Starting create tables with partitions");

$command = new SqlRunnerWithSuffixesCommand(
    $connection,
    $logger,
    $templatePath,
);

$tablesList = [
    'ADDR_OBJ_DIVISION',
    'ADDR_OBJ_PARAMS',
    'ADDRESSOBJECTS',
    'ADM_HIERARCHY',
    'APARTMENTS',
    'APARTMENTS_PARAMS',
    'CARPLACES',
    'CARPLACES_PARAMS',
    'CHANGE_HISTORY',
    'HOUSES',
    'HOUSES_PARAMS',
    'MUN_HIERARCHY',
    'NORMDOCS',
    'REESTR_OBJECTS',
    'ROOMS',
    'ROOMS_PARAMS',
    'STEADS',
    'STEADS_PARAMS',
];
$command->run(
    $tablesList,
    'create-partition.php',
    false,
    99,
    1

);

$finishMoment = hrtime(true);

$totalTime = $finishMoment - $startMoment;
$timeParts = new DurationPrinter();
$printout = $timeParts->printNanoseconds($totalTime);
$logger->notice("Creation tables duration is $printout");

$logger->notice('Script is finished');

$logger->close();
