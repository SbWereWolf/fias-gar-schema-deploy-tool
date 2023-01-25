<?php

declare(strict_types=1);

namespace SbWereWolf\FiasGarSchemaDeploy\DataStorage;

use JsonSerializable;
use SbWereWolf\JsonSerializable\JsonSerializeTrait;

class Printer implements JsonSerializable
{
    use JsonSerializeTrait;

    private string $templatesDirectory;

    public function __construct(string $templatesDirectory)
    {
        $this->templatesDirectory = rtrim(
            trim($templatesDirectory),
            DIRECTORY_SEPARATOR
        );
    }

    public function print(
        string $templateFile,
        array $values = []
    ) {
        $path = implode(
            DIRECTORY_SEPARATOR,
            [$this->templatesDirectory, $templateFile]
        );

        extract($values);

        ob_start();
        include($path);
        $printout = ob_get_contents();
        ob_end_clean();

        return $printout;
    }
}