<?php

namespace Ahuang\Transcription;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use JsonSerializable;

class Lines implements Countable , IteratorAggregate, ArrayAccess,JsonSerializable{
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

    public function offsetExists($key)
    {
        return isset($this->lines[$key]);
    }

    public function offsetGet($key)
    {
        return $this->lines[$key];
    }

    public function offsetSet($key,$value)
    {
        if(is_null($key))
        {
            $this->lines[] = $value;
        }else{
            $this->lines[$key] = $value;
        }

    }
    public function offsetUnset($key)
    {
        unset($this->line[$key]);
    }

    public function jsonSerialize()
    {
        return $this->lines;
    }

}