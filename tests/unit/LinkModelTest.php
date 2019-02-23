<?php

use App\Link;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class LinkModelTest extends TestCase
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

    /** @test */
    public function exception_is_thrown_with_no_id()
    {
        $this->expectException(\App\Exceptions\CodeGenerationException::class);

        $link = new Link;
        $link->getCode();
    }

    /** @test */
    public function can_get_model_by_code()
    {
        $link = factory(App\Link::class)->create([
            'code' => 'abc'
        ]);

        $model = $link->byCode($link->code)->first();

        $this->assertInstanceOf(Link::class, $model);
        $this->assertEquals($model->original_url, $link->original_url);
    }

    /** @test */
    public function can_get_shortened_url_from_link_model()
    {
        $link = factory(App\Link::class)->create([
            'code' => 'abc'
        ]);

        $this->assertEquals($link->shortenedUrl(), env('CLIENT_URL') . '/' . $link->code);
    }

    /** @test */
    public function null_is_returned_for_shortened_url_when_no_code_present_on_model()
    {
        $link = factory(App\Link::class)->create();

        $this->assertNull($link->shortenedUrl());
    }
}
