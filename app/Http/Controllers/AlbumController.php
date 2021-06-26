<?php

namespace App\Http\Controllers;

use App\Models\Album;

class AlbumController extends Controller
{
    public function index()
    {
        $validator = validator(request()->only('userId'), [
            'userId' => 'nullable|integer|min:1'
        ]);
        if($validator->fails()) {
            return $this->error($validator->errors());
        }
        $album = new Album;
        if(request('userId')) {
            $album->where('userId', request('userId'));
        }
        $albums = $album->withPhotos();
        return $this->success($albums->values());
    }
}
