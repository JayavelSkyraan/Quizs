<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
   
     //upload 
    public function uploadimage(Request $request)
    {
         $request->validate([
             'upload' => 'image',
         ]);
         if ($request->hasFile('upload')) {
               $url = $request->upload->store('ckedit_files');
               $CKEditorFuncNum = $request->input('CKEditorFuncNum');
               $url = asset('storage/app/'. $url);
               $msg = 'Image successfully uploaded';
               $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
               @header('Content-type: text/html; charset=utf-8');
               return $response;
           }
   }

}
