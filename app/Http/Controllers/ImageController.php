<?php

namespace App\Http\Controllers;
use App\FileEntry;
use App\FileUpload;

use App\Upload;
use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{

        public function home()
    {
        // add this
        $images = Upload::all();
        return view('cloud', compact('images'));
    }




    public function storee(Request $request)
    {
        $this->validate($request, [
            'image' => 'required'
        ]);

        if($request->get('image'))
        {
            $image = $request->get('image');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->get('image'))->save(public_path('images/').$name);
        }

        $image= new FileUpload();
        $image->image_name = $name;
        $image->save();

        return response()->json(['success' => 'You have successfully uploaded an image'], 200);
    }
    public function uploadImages(Request $request)
    {
       /* $this->validate($request, [
            'image_name' => 'required|mimes:jpeg,bmp,jpg,png|between:1, 6000',
        ]);
       */

        $image = $request->file('image_name');

        $name = $request->file('image_name')->getClientOriginalName();


        $image_name = $request->file('image_name')->getRealPath();;

        Cloudder::upload($image_name, null);


        list($width, $height) = getimagesize($image_name);

        $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height]);

        //save to uploads directory
        $image->move(public_path("uploads"), $name);

        //Save images
        $this->saveImages($request, $image_url);

        return redirect()->back()->with('status', 'Image Uploaded Successfully');
    }






        public function saveImages(Request $request, $image_url)
    {
        $image = new Upload();
        $image->image_name = $request->file('image_name')->getClientOriginalName();
        $image->image_url = $image_url;

        $image->save();
    }


    public function destroy($id)
    {
        $category = Upload::find($id);
        $image_name = $category->image_name;

        File::delete($image_name);
        $category->delete();
        Cloudder::destroy($id);
        return redirect()->back()->with('message', 'Başarılı');
    }

}
