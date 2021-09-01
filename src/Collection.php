<?php
namespace Ahuang\Transcription;

use Countable;
use ArrayAccess;
use ArrayIterator;
use JsonSerializable;
use IteratorAggregate;

class Collection implements Countable, IteratorAggregate, ArrayAccess, JsonSerializable{

    protected $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }


    public function offsetExists($key)
    {
        return isset($this->items[$key]);
    }

    public function offsetGet($key)
    {
        return $this->items[$key];
    }

    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }
    public function offsetUnset($key)
    {
        unset($this->items[$key]);
    }

    public function jsonSerialize()
    {
        return $this->items;
    }

    public function map(callable $fn):self
    {
        return new static(
            array_map($fn, $this->items)
        );
        return array_map($fn,$this->items);
    }


}