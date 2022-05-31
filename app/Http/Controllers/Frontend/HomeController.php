<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\history;
use App\Models\brand;
use App\Models\category;
use App\Models\User;
use App\Models\product;
use Auth;
use Mail;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getProducts = product::orderBy('created_at','DESC')->paginate(6);
        return view('frontend.shop.home',compact('getProducts'));
    }

    public function detail($id)
    {
        $getDetail = product::where('id',$id)->get();
        $getDetail = $getDetail[0];
        $getArrImage = json_decode($getDetail['image']);
        return view('frontend.shop.product-detail',compact('getDetail','getArrImage'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        return view('frontend.shop.cart');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function viewCheckOut()
    {
        if(session()->has('cart')){
            $product = session()->get('cart');       
            return view('frontend.shop.checkout',compact('product'));
        }
        else {
            return view('frontend.shop.checkout');
        }
    }

    public function checkOut(Request $request)
    {   
        if(session()->has('cart')){
            $getcart = session()->get('cart');
            foreach ($getcart as $key => $value){
                $cart_sendmail[] = array(
                    'name' => $value['name'],
                    'price' => $value['price'],
                    'qty' => $value['qty']
                );
            }
        }
        if($request->iduser){
            $iduser = $request->iduser;
            $name = $request->name;
            $email = $request->email;

            $mailtitle ="Xác nhận đơn hàng";
            $email_data = array(
                'cart' => $cart_sendmail,
                'user' => $name,
            );
            $shop = "nguyenpbao896@gmail.com";
            $result = Mail::send(['html'=>'email.email_template'], $email_data, function($message) 
                use ($shop,$email, $mailtitle){
                    $message->from($shop)->to($email)->subject($mailtitle);
            });
            session()->forget('cart');

        } 
        if(!$request->iduser) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->level = 0;
            $user->save();
            $check = 1;
            if($check ==1){
                $iduser = User::select('id')->orderBy('id','DESC')->first();
                $name = $request->name;  
                $email = $request->email;
                $mailtitle ="Xác nhận đơn hàng";
                $email_data = array(
                    'cart' => $cart_sendmail,
                    'user' => $name,
                );
                $shop = "nguyenpbao896@gmail.com";
                $result = Mail::send(['html'=>'email.email_template'], $email_data, function($message) 
                    use ($shop,$email, $mailtitle){
                        $message->from($shop)->to($email)->subject($mailtitle);
                });
                session()->forget('cart');        
            }      
        }
        $data = new history();
        $data->iduser = $iduser;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->price = $request->price;
        $data->save();

        return redirect('frontend/shop/home');
    }
    
    public function viewSearch()
    {
        $brand = brand::all();
        $category = category::all();
        return view('frontend.shop.search-advance',compact('brand','category'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $brand = brand::all();
        $category = category::all();
        $data = product::where('name', 'like', '%'. $search. '%' )->get()->toArray();
        // dd($data);
        return view('frontend.shop.search',compact('data','brand','category'));
        
    }
    
    public function searchAdvance(Request $request)
    {
        $brand = brand::all();
        $category = category::all();
        $product = product::query();
        if($request->name){
            $product->where('name','like','%'.$request->name.'%');
        }
        if($request->idcategory){
            $product->where('idcategory', $request->idcategory);
        }
        if($request->idbrand){
            $product->where('idbrand', $request->idbrand);
        }
        if($request->status){
            $product->where('status', $request->status);
        }
        if($request->price){
            $price = $request->price;
            $price = explode('-', $price);
            $product->whereBetween('price', [(int)$price[0] ,(int)$price[1]]);
        }

        $data = $product->orderBy('id','DESC')->get();
        
        // dd($data);
        return view('frontend.shop.search-advance',compact('data','category','brand'));
    }

    public function priceSearch(Request $request)
    {
       
        $price = $request->price;
        // dd($price);
        $price = explode(':',$price);
        
        $data = product::whereBetween('price', [(int)$price[0] , (int)$price[1]])->get()->toArray();
        // dd($data);
        if (!empty($data)) {
            return response()->json(['result'=>$data]);
        } else{
            return 0;
        }

    }
}
