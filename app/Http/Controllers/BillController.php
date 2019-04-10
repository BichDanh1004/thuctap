<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Bill;
use App\Cart;
use App\Users;
use App\CartDetail;
use App\BillDetail;
use App\Product;
use App\Image;
use Mail;
use Session;


class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $image = Image::all();
        if(Session::has('cart')){
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart = Session::get('cart');
        }
        else{
            return view('customer.page.billdetail');
        }
        $product = $cart->items;
        $totalQty = $cart->totalQty;
        $totalPrice = $cart->totalPrice;
    

        return view('customer.page.billdetail', ['product'=>$product,'img'=>$image,'totalPrice'=>$totalPrice]);
    }
    public function billdetail(Request $rq)
    {
        //
        $cart = Session::get('cart'); 
        $bill = new Bill;
        $bill->id_customer = Auth::id();
        $bill->date_order = date('y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->address = $rq->address;
        $bill->save();

        // $bil = Bill::orderBy('id', 'DESC')->first();
        foreach( $cart->items as $key => $value){
                        $bill_details = new BillDetail;
                        $bill_details->id_bill = $bill->id_bill;
                        $bill_details->id_product = $key;
                        $bill_details->quantity = $value['qty'];
                        $bill_details->total = ($value['price']/$value['qty']);
                        $bill_details->save();  
            }
            
        
      
        $product_cart = $cart->items;
        $data = ['name'=> $rq->name, 'address'=> $rq->address, 'phone_number'=> $rq->phone_number,
                    'sanpham'=>$product_cart, 'totalPrice'=> $cart->totalPrice,
                ];
        Mail::send('email', $data, function($msg){
            $msg->from('bichdanh1004@gmail.com','Danh');
            $msg->to('bichdanh1004@gmail.com','Diamond')->subject('Diamond');
        });
        Session::forget('cart');
        return redirect()->back()->with('message', 'Mua hàng thành công');
    }

    public function index()
    {
        $bills = Bill::all();
        return view('admin.bill.index',['bills'=>$bills]);
    }
}
