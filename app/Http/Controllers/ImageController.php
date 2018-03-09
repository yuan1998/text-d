<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Response;
use Storage;


class ImageController extends ApiController
{

    public function imageFile()
    {
      $filename = request('file');

      $file = Storage::disk('public')->get($filename);

      $type =Storage::disk('public')->mimeType($filename);

      $response = Response::make($file, 200);

      $response->header("Content-Type", $type);

      return $response;
    }

    public function saveFile()
    {

      $str = request('file');

      $r = $this->parseBase64($str);

      return $this->resultReturn($r);

    }

    public function removeImage()
    {

      $fileName = request('file');

      $r = $this->removeFile($fileName);

      return $this->resultReturn($r);

    }


    public function saveImage()
    {

        $file  = request()->file('img');

        if(! $file)
            return err('img not');
        $r = $file->store('public');
        return url(Storage::url($r));
        // return $this->resultReturn($r);
        // $fileName = self::createFileName()
        // url("/storage/app/public" .)

    }


    public static function createFileName($ext)
    {

      return date('Y-m-d-H-i-s') .'-'. rand(1010,2020). uniqid() .'.'. $ext;

    }





}
