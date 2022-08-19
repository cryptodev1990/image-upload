<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Postimage;
use Hamcrest\Core\HasToString;
use PhpParser\Node\Expr\AssignOp\Concat;

class ImageUploadController extends Controller
{
    //Add image
    public function addImage()
    {
        return view('add_image');
    }

    //Store image
    public function storeImage(Request $request)
    {
        $data = new Postimage();

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = "1.png";
            $file->move(public_path('Image'), $filename);
            $data['image'] = $filename;
        }
        $data->save();
        return redirect()->route('images.view');
    }

    public function viewImage()
    {
        $imageData = Postimage::all();
        return view('view_image', compact('imageData'));
    }

    public function detectFace()
    {
        $filename = 'Image\1.png';
        $img = imagecreatefrompng($filename);
        $command = escapeshellcmd('python Python/face.py --img_path '.$filename);
        $output = shell_exec($command);
        dump($output);
        $paramsArray = explode(" ", $output);
        $imgcrop = imagecrop($img, ['x' => (float)$paramsArray[0], 'y' => (float)$paramsArray[1], 'width' => 200, 'height' => 200]);
        if ($imgcrop !== false) {
            imagepng($imgcrop, 'img-cropped.png');
            imagedestroy($imgcrop);
            echo "Image cropped successfully";
        }
        $cropImagePath = 'img-cropped.png';
        echo "<img src=".$cropImagePath.">";
    }
}
