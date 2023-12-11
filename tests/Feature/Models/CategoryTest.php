<?php

namespace Tests\Feature\Models;

use App\Models\Category;
use App\Models\Template;
use Tests\TestCase;

class CategoryTest extends TestCase
{
//    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testInsertMainCategory(): void
    {
        $this->withoutExceptionHandling();
        $data = Category::factory()->make()->toArray();

        $instance = (new Category);
        $table = $instance->getTable();

        Category::query()->create($data);
        $this->assertDatabaseHas($table, $data);
    }

    public function testInsertMainCategoryHasTemplate(): void
    {
        $this->withoutExceptionHandling();
        $data = Category::factory()->has_template()->make()->toArray();

        $instance = (new Category);
        $table = $instance->getTable();

        Category::query()->create($data);
        $this->assertDatabaseHas($table, $data);
    }

    public function testInsertSubCategory(): void
    {
        $level = 4;
        $category = Category::factory()->create();
        for ($i = 0; $i < $level; $i++) {
            $tree = $category->tree ?? [];
            $tree[] = $category->id;
            $data = Category::factory()->make([
                'level' => 1 + $category->level,
                'parent_id' => $category->id,
                'tree' => $tree
            ])->toArray();
            $category = Category::query()->create($data);
            unset($data['tree']);
            $this->assertDatabaseHas('categories', array_merge($data, [
                'level' => 1 + $i,
//                'tree'=>json_encode($tree,true)
            ]));
        }
    }

    public function testRelationWithTemplate(): void
    {
        $category = Category::factory()
            ->for(Template::factory())
            ->create();

        $this->assertTrue(isset($category->template->id));
        $this->assertTrue($category->template instanceof Template);
    }
}
