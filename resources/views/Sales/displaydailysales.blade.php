@extends('adminlte::page')
@section('title','المبيعات')
@section('content_header')
  <h1>المبيعات اليومية</h1>
  <h5 class="text-center">ما تم بيعه = 300</h5>
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
            <form action="{!!route('displaysales')!!}" method="POST" class="d-inline">
              @csrf
              <input type="hidden" name="id" value="{{$sale->id}}">
              <button type="submit" class="btn btn-success btn-sm">عرض</button>
            </form>
          <form action="{!!route('editsales')!!}" method="POST" class="d-inline">
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

 @section('js')
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
