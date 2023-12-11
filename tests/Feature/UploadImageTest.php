<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UploadImageTest extends TestCase
{
    public function testUploadMethodCanUploadImage(): void
    {
        $image = UploadedFile::fake()->image('image.png');

        $this->actingAs(User::factory()->create())
            ->post(route('upload'), compact('image'))
            ->assertRedirect();
    }
}
