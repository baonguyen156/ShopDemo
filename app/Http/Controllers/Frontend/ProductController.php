<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\product;
use App\Models\category;
use App\Models\brand;
use Auth;
use Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id(); 
        $getProducts = product::where('iduser',$id)->get();
        
        // dd($getProducts);
        return view('frontend.myproduct.product',compact('getProducts','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand = brand::all();
        $category = category::all();
        return view('frontend.myproduct.addproduct',compact('brand','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $iduser = Auth::id();
        $data=[];
        if($request->hasfile('image'))
        {                     
            $data = $this->SaveImage($request->file('image'));          
        } 

        $product = new product();
        $product->iduser = $iduser;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->idcategory = $request->idcategory;
        $product->idbrand = $request->idbrand;
        $product->status = $request->status;
        $product->sale = $request->sale;
        $product->company = $request->company;
        $product->image = json_encode($data);
        $product->detail = $request->detail;
        $product->save();

        return back()->with('success', 'Your images has been successfully');
        
    }

    public function SaveImage($ImageRequest)
    {   
        
        foreach($ImageRequest as $image)
        {

            $iduser = Auth::id();
            $name = $image->getClientOriginalName();
            $name_2 = "hinhnho_".$image->getClientOriginalName();
            $name_3 = "hinhvua_".$image->getClientOriginalName();

            $path = public_path('upload/product/'.$iduser.'/'. $name);
            $path2 = public_path('upload/product/'.$iduser.'/'.$name_2);
            $path3 = public_path('upload/product/'.$iduser.'/'.$name_3);

            Image::make($image->getRealPath())->save($path);
            Image::make($image->getRealPath())->resize(50, 70)->save($path2);
            Image::make($image->getRealPath())->resize(200, 300)->save($path3);
       
            $data[] = $name;     
        }
        return $data;  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getProduct = product::where('id',$id)->get();
        $getProduct = $getProduct[0];
        $getArrImage = json_decode($getProduct['image']);
        $brand = brand::all();
        $category = category::all();
        $iduser = Auth::id();

        return view('frontend.myproduct.editproduct',compact('getProduct','getArrImage','brand','category','iduser'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $iduser = Auth::id();
        $getProduct = product::find($id);
        $ImageOld = [];
        $ImageOld = json_decode($getProduct['image']);
        $ImageNew = [];

        $data = $request->all();

        if($data['image_delete']){
            foreach ($data['image_delete'] as $key => $imagedel){
                if(in_array($imagedel, $ImageOld)){
                    $delete = array_search($imagedel, $ImageOld);
                    unset($ImageOld[$delete]);
                    unlink('upload/product/'.$iduser.'/'.$imagedel);
                    unlink('upload/product/'.$iduser.'/hinhnho_'.$imagedel);
                    unlink('upload/product/'.$iduser.'/hinhvua_'.$imagedel);
                }
            }
        }

        if($request->hasfile('image')){
            $count = count($request->file('image'));
            $count1 = count($ImageOld);
            $total = $count + $count1;
            if($total > 3){
                return back()->withErrors('The product has only 3 pictures');
            } else {
                $ImageNew = $this->SaveImage($request->file('image'));
            }
        }

        $Image = array_merge($ImageOld, $ImageNew);
        $data['image'] = json_encode($Image);
        $getProduct->update($data);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product::where('id',$id)->delete();
        return redirect()->back();
    }
}
