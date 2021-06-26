<?php

use App\Models\Photo;
use Illuminate\Support\Collection;

class PhotoModelTest extends TestCase
{
    protected Photo $model;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new Photo;
    }

    public function testGetAllPhotos()
    {
        $photos = $this->model->get();
        $this->assertInstanceOf(Collection::class, $photos);
    }
}
