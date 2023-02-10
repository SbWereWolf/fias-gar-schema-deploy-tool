<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\LogRecord;
use SbWereWolf\FiasGarSchemaDeploy\Cli\ExecuteSqlFromTemplatesCommand;
use SbWereWolf\Scripting\Config\EnvReader;
use SbWereWolf\Scripting\Convert\DurationPrinter;
use SbWereWolf\Scripting\FileSystem\Path;

$startMoment = hrtime(true);

$message = 'Script is starting';
echo $message . PHP_EOL;

$pathParts = [__DIR__, '..', 'vendor', 'autoload.php'];
$autoloaderPath = join(DIRECTORY_SEPARATOR, $pathParts);
require_once($autoloaderPath);

$logger = new Logger('common');

$pathComposer = new Path(__DIR__);
$logsPath = $pathComposer->make(
    [
        'logs',
        pathinfo(__FILE__, PATHINFO_FILENAME) . '-' . time() . '.log',
    ]
);

$writeHandler = new StreamHandler($logsPath);
$logger->pushHandler($writeHandler);

$logger->pushProcessor(function ($record) {
    /** @var LogRecord $record */
    echo "{$record->datetime} {$record->message}" . PHP_EOL;

    return $record;
});

$logger->notice($message);

$configPath = $pathComposer->make(['config.env']);
$env = new EnvReader($configPath);

$logger->notice('Script run with params:' . json_encode($env));
$env->defineConstants();

$connection = (new PDO(
    constant('DSN'),
    constant('LOGIN'),
    constant('PASSWORD'),
));
$schema = constant('SCHEMA');
$connection->exec("SET search_path TO {$schema}");

$logger->notice("Starting create tables");

$connection->beginTransaction();

$templatesPath = $pathComposer->make(['template']);
$command = new ExecuteSqlFromTemplatesCommand(
    $connection,
    $logger,
    $templatesPath,
);

$templatesKitList = [
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
$command->run($templatesKitList, 'create-table.php');

$logger->notice("Starting create tables with partitions");

$templatesKitList = [
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
    $templatesKitList,
    'create-partition.php',
    99,
    false,
    1

);

$connection->commit();

$finishMoment = hrtime(true);
$totalTime = $finishMoment - $startMoment;

$timeParts = new DurationPrinter();
$printout = $timeParts->printNanoseconds($totalTime);
$logger->notice("Creation tables duration is $printout");

$logger->notice('Script is finished');

$logger->close();
