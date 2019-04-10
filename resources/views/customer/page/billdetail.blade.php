@extends('customer.layout.master')
@section('content')
<div class="container">
    <form action="billdetail" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="row">
            <p class="mb-3 mt-3 text-success"> 
                @if( Session::has('thongbao')) {{Session::get('thongbao')}}
                @endif
            </p>
        </div>
        <div class="row">
            <h3 class="mb-5 "> Đặt hàng </h3>
        </div>
        <div class="row mb-5">
            <div class="col-md-6">
            @if(Auth::check())             
                <div class="form-block">
                    <label for="name"> Full name*: </label>
                    <input type="text" id="name" name="name" placeholder="Họ tên" required="" class="Bill_input" value="{{Auth::user()->name}}">
                </div>
                <div class="form-block">
                    <label for="email"> Email: </label>
                    <input type="email" id="email"  name="email" required="" class="Bill_input" value="{{Auth::user()->email}}" readonly="">

                </div>
                <div class="form-block">
                    <label for="address"> Address*: </label>
                    <input type="text" id="address" name="address" placeholder="Address" required="" class="Bill_input" value="{{Auth::user()->address}}">
                </div>
                <div class="form-block">
                    <label for="phone_number"> Phone_number*: </label>
                    <input type="text" id="phone_number" name="phone_number" placeholder="Phone number" required="" class="Bill_input" value="{{Auth::user()->phone_number}}">
                </div>

            @endif
            </div>

            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header"> <h4> Đơn hàng của bạn </h4> </div>
                    <ul class="list-group list-group-flush">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if(Session::has('cart'))
                    @foreach($product as $pr)
                        <li class="list-group-item">                            
                        <div class="media">
								@foreach($img as $image)
                                @if ($pr['item']['id_product'] == $image->id_product)
									<img class="pull-left mx-4" src="customer/images/{{$image->img_path}}" alt="">
							    @endif
                                @endforeach                      
                            <div class="pull-right" >
                                <p class="text-danger text-capitalize">{{$pr['item']['product_name']}}</p>
                                <span> <b> Price: </b>{{number_format($pr['item']['price'])}} đ </span>
                                <span> <b> Quantity: </b> {{$pr['qty']}} </p> </span>
                            </div>                          
                        </li>
                        @endforeach
                        <li class="list-group-item">
                            <div class="d-flex flex-row ">
                                <h4 class="pr-3"> Tổng tiền:</h4><h4> {{number_format(Session('cart')->totalPrice)}} VND  </h4>
                            </div>
                            
                        </li>
                    @endif
                    </ul>
                   
                </div>
                <div class="card ">
                    <div class="card-header"> <h4> Hình thức thanh toán </h4> </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="">
                                <input type="radio" name="payment" value="ATM" checked> Chuyển khoản <br>
                                <div class="d-flex flex-column pl-5">
                                    <span> Chuyển khoản đến tài khoản: </span>
                                    <span> - STK: 2022244149 </span>
                                    <span> - Chủ TK: Nguyễn Thị Bích Danh </span>
                                    <span> - Ngân hàng Agribank </span>
                                </div>
                            </li>
                            <li class="">
                                <input type="radio" name="payment" value="COD" checked> Thanh toán khi nhận hàng <br>
                                <div class="pl-5">
                                    <span> Nhận tiền khi giao hàng tận nơi </span>                                   
                                </div>
                            </li>
                        </ul>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-outline-info ">
                                Hoàn thành
                            </button>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
</form>
    </div>
@endsection