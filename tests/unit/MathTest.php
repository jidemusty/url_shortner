<?php

use App\Link;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class MathTest extends TestCase
{
    protected $mappings = [
        1 => 1,
        100 => '1C',
        1000000 => '4c92'
    ];

    /** @test */
    public function correct_code_is_generated()
    {
        $link = new Link;

        foreach ($this->mappings as $id => $expectedCode) {
            $link->id = $id;
            $this->assertEquals($link->getCode(), $expectedCode);
        }
    }
}
