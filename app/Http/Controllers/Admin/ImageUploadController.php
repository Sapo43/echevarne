<?php
   
namespace App\Http\Controllers\Admin;
  
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\ImageModal;
  
class ImageUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUpload()
    {
        return view('admin.modalInicio.abmModalInicio');
    }
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadPost(Request $request)
    {
        
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
     
  
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);
        $file=new ImageModal();
        $file->name=$imageName;
        $file->desde=$request->desde;
        $file->hasta=$request->hasta;
        $file->url=public_path('images').'/'.$imageName;
        $file->save();
        
   
        return back()
            ->with('success','Imagen subida correctamente.')
            ->with('image',$imageName);
   
    }
}