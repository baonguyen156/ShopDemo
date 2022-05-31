<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function addToCart(Request $request)
    {       
        $idproduct = $request->idproduct;
        $product = product::find($idproduct)->toArray();
        if(session()->has('cart')){
            $cart = session()->get('cart');
            if(isset($cart[$idproduct])){
                $cart[$idproduct]['qty'] +=1;           
            } else {
                $cart[$idproduct] = $product;
                $cart[$idproduct]['qty'] = 1;     
            }
        }
        else {
            $cart[$idproduct] = $product;
            $cart[$idproduct]['qty'] = 1;
                
        }
        session()->put('cart',$cart);
    }

    public function showCart()
    {
        if(session()->has('cart')){
            $product = session()->get('cart');       
            return view('frontend.shop.cart',compact('product'));
        }
        else {
            return view('frontend.shop.cart');
        }
    }

    public function delete($id)
    {
        if(session()->has('cart')){
            $sessioncart = session()->pull('cart');
            foreach ($sessioncart as $key => $value){
                if($value['id']==$id){
                    unset($sessioncart[$key]);
                }
            }
            session()->put('cart',$sessioncart);         
        }
        $getsession = session()->get('cart');
        if (empty($getsession)) {
            session()->forget('cart');
        }
        return back();
    }

    public function updateQty(Request $request)
    {
        $idproduct = $request->idproduct;
        $qty = $request->qty;   
        $sessioncart = session()->pull('cart'); 
        foreach ($sessioncart as $key => $value){ 
            if($value['id']==$idproduct){ 
                if($qty > 0){
                    $sessioncart[$key]['qty'] = $qty;
                }
                else {
                    unset($sessioncart[$key]);
                }
            }    
        }  
        session()->put('cart',$sessioncart);
        $getsession = session()->get('cart');
        if (empty($getsession)) {
            session()->forget('cart');
        }            
    }
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
}
