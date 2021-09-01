<?php
namespace Tests;

use ArrayAccess;
use Ahuang\Transcription\Line;
use PHPUnit\Framework\TestCase;
use Ahuang\Transcription\Transcription;

class TranscriptionTest extends TestCase
{
    protected $transcription ;

    protected function setup():void
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $this->transcription = Transcription::load($file);
    }

    /** @test */
    public function it_loads_a_vtt_file_as_a_string()
    {

        $this->assertStringContainsString('Here is a',$this->transcription);
        $this->assertStringContainsString('example of a VTT file.', $this->transcription);

        // $this->assertStringEqualsFile(
        //     $file,
        //     $this->transcription
        // );

        // $expected = file_get_contents($file);

        // $this->assertEquals($expected, $this->transcription);
    }

    /** @test */
    public function it_can_convert_to_an_array_of_line_objects()
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        // var_dump(Transcription::load($file)->lines());
        $lines = $this->transcription->lines();

        $this->assertCount(2 ,$lines);

        $this->assertContainsOnlyInstancesOf(Line::class, $lines);

    }

    /** @test */
    public function it_discard_irrelevant_lines_form_the_vtt_file()
    {

        $this->assertStringNotContainsString('WEBVTT',$this->transcription);

        $this->assertCount(2,$this->transcription->lines());

    }


    /** @test */
    public function it_render_the_lines_as_html()
    {


        $expected = <<<EOT
<a href="?time=00:03">Here is a</a>
<a href="?time=00:04">example of a VTT file.</a>
EOT;

        $result  = $this->transcription->lines()->asHtml();


        $this->assertEquals($expected, $result);

    }

    /** @test */
    public function it_support_array_access()
    {
        $lines = $this->transcription->lines();

        $this->assertInstanceOf(ArrayAccess::class,$lines);

        $this->assertInstanceOf(Line::class, $lines);
    }

}