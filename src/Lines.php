<?php

namespace Ahuang\Transcription;



class Lines extends Collection
{
    // protected $lines;

    // public function __construct(array $lines)
    // {
    //     $this->lines = $lines;
    // }

    public function asHtml(): string
    {
        // $htmlLines =  array_map(
        //     function (Line $line) {
        //         return $line->toHtml();
        //     },
        //     $this->items
        // );
        // return (new static($htmlLines))->__toString();

        return  $this->map(function (Line $line) {
                return $line->toHtml();
            })->__toString();

        // return $htmlLines->__toString();
        // return implode("\n", $htmlLines);
    }

    public function asPdf()
    {

    }

    public function __toString()
    {
        return implode("\n", $this->items);
    }



}