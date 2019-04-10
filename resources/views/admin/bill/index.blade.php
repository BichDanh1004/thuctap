@extends('admin.layout')
@section('custom-container')
<h3>Quản lý hóa đơn</h3>
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th>#</th>
        <th>Id_customer</th>
        <th>Date Order</th>
        <th>Total</th>
        <th>Show</th>
        
       
      </tr>
    </thead>
    <tbody>
      
        @foreach($bills as $bill)
        
      <tr>
        <td>{{$bill->id_bill}}</td>
        <td>{{$bill->id_customer}}</td>
        <td>{{$bill->date_order}}</td>
        <td>{{number_format($bill->total) }} VNĐ</td> 
  
        <form action=""  method="POST">
             <input type="hidden" name="_method" value="PUT">
             {{ csrf_field() }}
             
             <td>
          <form action="" method="GET">
          <button class="btn btn-info"><i class="fas fa-info-circle"></i></button>
          </form>
        </td>
       
        
      </tr>

   @endforeach 
    </tbody>
  </table>

@endsection