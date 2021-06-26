<?php

use App\Models\Album;
use Illuminate\Support\Collection;

class AlbumModelTest extends TestCase
{
    protected Album $model;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new Album;
    }
    public function test_get_all_albums()
    {
        $albums = $this->model->get();
        $this->assertInstanceOf(Collection::class, $albums);
    }
    public function test_album_with_photos()
    {
        $albums = $this->model->withPhotos();
        $this->assertInstanceOf(Collection::class, $albums);
        dd($albums);
    }
}
