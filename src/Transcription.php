<?php
namespace Ahuang\Transcription;

class Transcription{


    protected array $lines;

    public function __construct($lines)
    {

        $this->lines = $this->discardInvalidLines($lines);
    }

    public static function load(string $path): self
    {
        $lines = file($path);
        return new static($lines);

    }

    protected function discardInvalidLines(array $lines): array
    {
        $lines = array_map('trim',$lines);
        return array_slice(array_filter($lines),1);

        //or
        //array_shift($lines);
        //return $lines;

        // return array_values(array_filter(
        //     array_map('trim', $lines),
        //     function($line){
        //         $line = trim($line);
        //         return Line::valid($line);
        //     }));

    }

    public function lines(): Lines
    {

        return new Lines(array_map(function($line){
            return new Line(...$line);
        }, array_chunk($this->lines, 3)));

        // $lines= array_chunk($this->lines, 3);

        // return array_map(function($line){

        //     return new Line(...$line);
        //     // return new Line($line[0],$line[1],$line[2]);

        // },$lines);

    }

    public function htmlLines(): string
    {
        $htmlLines =  array_map(
            function(Line $line){
                return $line->toAnchorTag();
            },
            $this->lines()
        );

        return implode("\n",$htmlLines);
    }

    public function __toString(): string
    {
        return implode("\n",$this->lines);
    }

}