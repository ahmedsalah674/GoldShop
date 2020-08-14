@extends('adminlte::page')
@section('title','المبيعات')
@section('content_header')
@include('message')
<h1>المبيعات يوم {{$date}}</h1>
  <h5 class="text-center">ما تم بيعه = {{$day->sales}} </h5>
 <div class="text-center">
    <h5 class="d-inline m-5">قم بأختيار اليوم لعرض ما تم بيعه</h5>
    <form class="d-inline m-5" id="form">
    <input type="date"  name="date" id="datepicker" class="datepicker form-control w-25 d-inline" >
    </form>
  </div>
@endsection
@section('content')
<input class="form-control mb-4 " id="productsTable" type="text"
      placeholder="يمكنك البحث عن العميل عن طريق الاسم او رقم الهاتف">
  
  <table class="table table-hover ">
    <thead class="text-center">
      <th>اسم العميل</th>
      <th>رقم الهاتف</th>
      <th>الوزن</th>
      <th>العيار</th>
      <th>السعر</th>
      <th>نوع القطعة</th>
      <th>نوع العملية</th>
      <th>التاريخ</th>
    </thead>
      <tbody id="productsTable" class="text-center">
      @foreach ($sales as $sale)
        <tr>
          <td>{{$sale->name}}</td>
          <td>{{$sale->tel}}</td>
          <td>{{$sale->weight}}</td>
          <td>{{$sale->caliber}}</td>
          <td>{{$sale->price}}</td>
          <td>{{$sale->typetitle}}</td>
          @if($sale->type == 0)
            <td>كاش</td>
          @else
            <td>قسط</td>
          @endif
          <td>{{$sale->created_at}}</td>

          <td>
          <a href="{!!route('display.sales',$sale->id)!!}"class="btn btn-success btn-sm" >عرض</a>
          @if(!($sale->type && $sale->finsh)|| !$sale->type)
          <form action="{!!route('edit.sales')!!}" method="POST" class="d-inline">
            @csrf
            <input type="hidden" name="id" value="{{$sale->id}}">
            <button type="submit" class="btn btn-primary btn-sm">تعديل</button>
          </form>
          @endif
          </td>
        </tr>
      @endforeach
    </tbody>  
  </table>
  <div class="row d-flex justify-content-center ">
    <div class="  ">{{$sales->links()}}</div>
    </div>
@endsection
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
<style>
  [type="date"]::-webkit-calendar-picker-indicator {
    display: none;}
</style>
@endsection
 @section('js')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script>$( ".datepicker" ).datepicker({format: 'yyyy-mm-dd',});</script>  
<script>
  $(document).ready(function(){
    $("#productsTable").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#productsTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
  </script>
  <script>
    $('#datepicker').on('change',function(){
          $("#form").submit();
      });
  </script>
@endsection 

