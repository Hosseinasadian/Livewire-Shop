<?php

namespace Tests\Feature\Models;

use App\Models\Template;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TemplateTest extends TestCase
{
//    use RefreshDatabase;

    public function testInsert():void
    {
        $data = Template::factory()->make()->toArray();

        $instance = (new Template);
        $table = $instance->getTable();

        Template::query()->create($data);
        $this->assertDatabaseHas($table, $data);
    }
}
