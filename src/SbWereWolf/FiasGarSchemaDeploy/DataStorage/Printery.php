<?php

declare(strict_types=1);

namespace SbWereWolf\FiasGarSchemaDeploy\DataStorage;

use Generator;
use JsonSerializable;
use Psr\Log\LoggerInterface;
use SbWereWolf\JsonSerializable\JsonSerializeTrait;

class Printery implements JsonSerializable
{
    use JsonSerializeTrait;

    private Printer $printer;
    private LoggerInterface $logger;

    public function __construct(
        string $templatePath,
        LoggerInterface $logger,
    ) {
        $this->printer = new Printer($templatePath);
        $this->logger = $logger;
    }

    /**
     * @param array $templatesKit
     * @param string $template
     * @param int $copies
     * @param bool $printWithEmptySuffix
     * @param int $copiesOffset
     * @return Generator|string
     */
    public function makePrintouts(
        array $templatesKit,
        string $template,
        int $copies = 0,
        bool $printWithEmptySuffix = false,
        int $copiesOffset = 0
    ): Generator {
        $range = [];
        if ($copies !== 0) {
            $range = range($copiesOffset, $copies);
        }
        foreach ($templatesKit as $kit) {
            $message = "Starting make printouts" .
                " within range `{$copiesOffset}` - `{$copies}`" .
                " using templates kit `{$kit}`";
            $this->getLogger()->info($message);

            $parts = [
                '.',
                $kit,
                $template,
            ];
            $templatePath = implode(DIRECTORY_SEPARATOR, $parts);

            if ($printWithEmptySuffix || $copies === 0) {
                $suffix = '';
                $values = compact('suffix');

                $message =
                    "Printing {$template} without suffix" .
                    " (`{$suffix}`)";
                $this->getLogger()->info($message);

                $printout = $this
                    ->getPrinter()
                    ->print($templatePath, $values);

                yield $printout;
            }

            foreach ($range as $index) {
                $suffix = str_pad((string)$index, 2, '0', STR_PAD_LEFT);
                $values = compact('suffix');

                $message =
                    "Printing {$template} with suffix (`{$suffix}`)";
                $this->getLogger()->info($message);

                $printout = $this
                    ->getPrinter()
                    ->print($templatePath, $values);

                yield $printout;
            }
        }
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @return Printer
     */
    private function getPrinter(): Printer
    {
        return $this->printer;
    }
}