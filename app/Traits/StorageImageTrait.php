<?php
namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait StorageImageTrait {
     public function strageTraitUpload (Request $request , $fieldName , $folderName)
     {
        if($request->hasFile($fieldName))
        {

            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $request->file($fieldName)->storeAs('public/' . $folderName . '/'. auth()->id(), $fileNameHash);
            $dataUpload = 
            [
                'file_name' =>$fileNameOrigin,
                'file_path' => Storage::url($filePath)
            ];
            return $dataUpload;
        }
        return null;
     }
}