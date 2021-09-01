<?php
namespace Ahuang\Transcription;

class Line{

    public int $position;
    public string $timestamp;
    public string $body;


    public function __construct($position,$timestamp,$body)
    {
        $this->position= $position;
        $this->timestamp= $timestamp;
        $this->body= $body;

    }

    public function beginningTimestamp()
    {
        preg_match('/^\d{2}:(\d{2}:\d{2})\.\d{3}/', $this->timestamp, $matchs);

        return $matchs[1];
    }


    public function toAnchorTag()
    {
        return '<a href="?time=' . $this->beginningTimestamp() . '">' . $this->body . '</a>';
    }


    public static function valid($line)
    {
        return $line !== "WEBVTT" && $line !== '';
        // return $line !== "WEBVTT" && $line !== '' && !is_numeric($line);
    }

}