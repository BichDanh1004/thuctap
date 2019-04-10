<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Image;
use App\User;
use Mail;
use App\Http\Requests\ImageRequest;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{

public function home() {
    $product = Product::paginate(8);
    $img = Image::all();
    return  view('customer.page.home', ['product'=>$product, 'img'=>$img]);
}

public function create($id_product)
{   $product = Product::find($id_product);
    $images = Product::find($id_product)->images;
    return view('admin.image.create',['product'=>$product,'images'=>$images]);
}

public function store(ImageRequest $request,$id_product)
{   
    $image = new Image;
    $image->id_product = $request ->id_product;
    if($request->hasFile('images')){
        $file = $request->file('images');
        $duoi = $file->getClientOriginalExtension();
        if($duoi != 'jpg' && $duoi !='png'&& $duoi != 'jpeg')
        {
            return redirect('admin.image.create')->with('err','chi duoc chon file jpg,png,jpeg');
        }
        $name = $file->getClientOriginalName();
        $file->move('upload',$name);
        $image->img_path=$name;

    }
   $image->save();
}

public function destroy($id_image)
{ 
  $image = Image::find($id_image);
  $oldImage=$image->img_path;
  Storage::delete('public/products/'.$oldImage);
  $image = Image::destroy($id_image);
  return redirect()->back()->with('message','Xóa ảnh thành công');

}

public function getlienhe()
{
return view('customer.page.contact');
}
public function postlienhe()
{
$data = ['name'=>'ten'];
    Mail::send('email', $data, function($msg){
       $msg->from('bichdanh1004@gmail.com','danh');
       $msg->to('bichdanh1004@gmail.com','danh')->subject('mail danh');
   });
}
}


