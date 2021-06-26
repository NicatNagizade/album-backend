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
    public function testGetAllAlbums()
    {
        $albums = $this->model->get();
        $this->assertInstanceOf(Collection::class, $albums);
    }
}
