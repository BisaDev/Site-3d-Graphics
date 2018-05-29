<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PositionsController extends Controller
{
    public function show($position)
    {

        $positionPath = 'public/positions/' . $position . '.json';
        $positionExists =  Storage::disk('local')->exists($positionPath);

        if (!$positionExists){
            abort(404);
        }

        $position =  Storage::disk('local')->get($positionPath);
        return response()->json(json_decode($position));
    }

    public function thanks()
    {
        $gifsDirectory = 'img/gifs';
        $gifs = File::allFiles(public_path($gifsDirectory));
        $randomGifName = $gifs[array_rand($gifs)]->getFilename();
        $randomGif = asset($gifsDirectory . '/' . $randomGifName);

        return response()->json(['success' => true, 'gif' => $randomGif]);
    }
}
