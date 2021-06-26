<?php

namespace App\Models;

class Album extends BaseModel
{
    protected $endpoint = 'albums';

    public function withPhotos()
    {
        $albums = $this->get();
        $photo = new Photo();
        $photos = $photo->get();
        $albums->map(function ($album) use ($photos) {
            $album->photos = $photos->where('albumId', $album->id)->values();
        });
        return $albums;
    }
}
