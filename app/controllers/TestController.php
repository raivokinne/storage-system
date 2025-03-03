<?php
namespace App\Controllers;

use Core\FileUpload;
use Core\Request;

class TestController extends Controller
{
    /**
     * @return void
     */
    public function test(Request $request)
    {
        $file = new FileUpload('file'); // Specify the input file name.
        $file->path('/upload/');        // Specify the files destination path.
        $file->createRandomName();      // Generate random name.
        $file->upload();                // move uploaded files (You should call this method at the end).

        // Display errors as array
        $file->displayUploadErrors();

        // Check if the files uploaded or not
        if ($file->success()) {
            // Success
            echo 'Files have been uploaded';
        } else {
            // Failed
        }
    }
    /**
     * @return void
     */
    public function idk(Request $request)
    {
        return view('test');
    }
}
