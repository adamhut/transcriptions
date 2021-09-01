<?php

namespace Ahuang\Transcription;

use ArrayIterator;
use Countable;
use IteratorAggregate;

class Lines implements Countable , IteratorAggregate{
    protected $lines;

    public function __construct(array $lines)
    {
        $this->lines = $lines;
    }


    public function asHtml(): string
    {
        $htmlLines =  array_map(
            function (Line $line) {
                return $line->toAnchorTag();
            },
            $this->lines
        );

        return implode("\n", $htmlLines);
    }

    public function asPdf()
    {

    }

    public function count():int
    {
        return count($this->lines);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->lines);
    }

    public function __toString()
    {
        return;
    }

}