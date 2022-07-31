<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart=Cart::instances(Auth::user()->id)->content();
        $total=0;
        foreach($cart as $c){
            $total+=$c->qty*$c->price;

        }
        return view('cart.index',compact('cart','total'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cart::instance(Auth::user()->id)->add(
            [
                'id'->$request->id,
                'name'->$request->name,
                'qty'->$request->qty,
                'price'->$request->price,
                'wegth '->$request->wegth,

            ]
            );
            return redirect()->route('product.show',$request->get('id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cart=DB::table('shoppingcart')->where('instance',Auth::user()->$id)->where('identifier',$count)->get();
        return view('cart.show', compact('cart'));
    }

    public function update(Request $request)
    {
        if ($request->input('delete')){
            Cart::instance(Auth::user()->id)->remove($request->input('id'));
        
        }else{
            Call::instace(Auth::user()->id)->update($request->input('qty'));
        }
        return redirect()->route('Carts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user_shoppingcarts=DB::table('shoppingcart')->where('instance',Auth::user()->id)
        ->get();
        $count=$user_shoppingcarts->count();
        $count+=1;
        Cart::instace(Auth::user()->id);
        DB::table('shoppingcart')->where('instance',Auth::user()->id)->where('number',null)->update(['number'=>$count,'buy_flag'=>true]);
        Cart::instace(Auth::user()->id)->destroy();
        return redirect()->route('cart.index');
    }
}
