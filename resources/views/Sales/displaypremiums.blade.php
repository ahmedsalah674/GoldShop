@extends('adminlte::page')
@section('title','الاقساط')
@section('content_header')
  <h1>الاقساط التي لم يتم تسديدها</h1>
@include('message')
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
        @if ($sale->role)
            @continue
        @endif
          <tr>
            <td>{{$sale->name}}</td>
            <td>{{$sale->tel}}</td>
            <td>{{$sale->weight}}</td>
            <td>{{$sale->caliber}}</td>
            <td>{{$sale->price}}</td>
            <td>{{$sale->typetitle}}</td>
            <td>قسط</td>
            <td>{{$sale->created_at}}</td>
            <td>
              <form action="{!!route('display.sales')!!}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="id" value="{{$sale->id}}">
                <button type="submit" class="btn btn-success btn-sm">عرض</button>
              </form>
             <form action="{!!route('edit.sales')!!}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="id" value="{{$sale->id}}">
                <button type="submit" class="btn btn-primary btn-sm">تعديل</button>
              </form>
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
  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet"/> --}}
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
  
@endsection 

