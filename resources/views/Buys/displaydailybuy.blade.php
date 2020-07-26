@extends('adminlte::page')
@section('title','المشتريات')
@section('content_header')
  <h1>المشتريات اليومية</h1>
  <h5 class="text-center">ما تم صرفه اليوم = 300 </h5>
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
      <th>التاريخ</th>
    </thead>
    <tbody id="productsTable" class="text-center">
      @foreach ($buys as $buy)
        <tr>
          <td>{{$buy->name}}</td>
          <td>{{$buy->tel}}</td>
          <td>{{$buy->weight}}</td>
          <td>{{$buy->caliber}}</td>
          <td>{{$buy->price}}</td>
          <td>{{$buy->typetitle}}</td>
          <td>{{$buy->typetitle}}</td>
          <td>
            <form action="{!!route('displaybuy')!!}" method="post" class="d-inline">
              @csrf
              <input type="hidden" name="id" value="{{$buy->id}}">
              <button type="submit" class="btn btn-success btn-sm">عرض</button>
            </form>
            <form action="{!!route('editbuy')!!}" method="post" class="d-inline">
              @csrf
              <input type="hidden" name="id" value="{{$buy->id}}">
              <button type="submit" class="btn btn-primary btn-sm">تعديل</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div class="row d-flex justify-content-center ">
    <div >{{$buys->links()}}</div>
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
