@extends('customer.layout.master')
@section('content')
<div class="container">
		<div id="content" class="product">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-3">
						<ul class="aside-menu">
						    <li><a href="product/3">Nhẫn</a></li>
							<li><a href="product/2">Vòng Tay</a></li>
							<li><a href="product/1">Dây Chuyền</a></li>
							<li><a href="product/11">Khuyên Tai</a></li>
							<li><a href="product/8">Bộ Trang Sức</a></li>
							
							<!-- @foreach($protype as $pt)
							<li>{{$pt->name_product_type}}</li>
							@endforeach -->
						</ul>
					</div>
					<div class="col-sm-9">
						<div class="beta-products-list">
							<h4>New Products</h4>
							<div class="row ">
											
								
							    	@foreach($proty as $pro)
									<div class="col-4 ">
										<div class="card ">
										@foreach($img as $image)
										@if ($pro->id_product == $image->id_product)
											<img class="card-img-top " src="customer/images/{{$image->img_path}}" alt="Card image cap ">
										@endif
										@endforeach
											<div class="card-body ">
											<p class="card-left ">{{$pro->product_name}}</p>
												<p class="card-left ">{{number_format($pro->price)}} vnđ</p>
												<a href="productdetail/{{$pro->id_product}}" class="btn btn-primary ">Xem Chi Tiết</a>
												@if(Auth::check())
													<button class="btn btn-primary"> 
														<a href="{{route('themgiohang',$pro->id_product)}}"><i class="fas fa-shopping-cart text-white"></i></a>
													</button>
													@else
														<button class="btn btn-primary"> 
															<a href="login"><i class="fas fa-shopping-cart text-white"></i></a> 
														</button>     
													@endif
											
											</div>
										</div>
									</div>								
									@endforeach
							
		
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection