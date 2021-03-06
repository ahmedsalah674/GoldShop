@extends('adminlte::page')
@section('title','المشتريات')
@section('content_header')
@include('message')
  <h1>المشتريات اليومية {{$date}}</h1>
  <h5 class="text-center">ما تم شرائه = {{number_format($day->buys)}} </h5>
  <div class="text-center">
    <h5 class="d-inline m-5">قم بأختيار اليوم لعرض ما تم شرائه</h5>
    <form class="d-inline m-5" id="form">
    <input type="date"  name="date" id="datepicker" class="datepicker form-control w-25 d-inline" value="{{$date}}" >
    </form>
  </div>
@endsection
@section('content')
<input class="form-control mb-4 " id="productsTable" type="text"
      placeholder="يمكنك البحث عن العميل عن طريق الاسم او رقم الهاتف">
  
  <table class="table table-hover ">
    <thead class="text-center">
      <th>اسم العميل</th>
      {{-- <th>رقم الهاتف</th> --}}
      <th>الوزن</th>
      <th>العيار</th>
      <th>السعر</th>
      <th>نوع القطعة</th>
      <th>التاريخ</th>
      <th>الوقت</th>
    </thead>
    <tbody id="productsTable" class="text-center">
      @foreach ($buys as $buy)
        <tr>
          <td>{{$buy->name}}</td>
          {{-- <td>{{$buy->tel}}</td> --}}
          @if($buy->weight > 1000)
            <td>{{round(($buy->weight / 1000),4)}}كيلو</td>
          @else
            <td>{{round(($buy->weight),4)}}جرام</td>
          @endif
          <td>{{$buy->caliber}}</td>
          <td>{{number_format($buy->price)}}جنيه</td>
          <td>{{$buy->typetitle}}</td>
          <td>{{$buy->created_at->format('d-m-Y')}}</td>
          <td>{{$buy->created_at->format('h:i')}}</td>
          <td>
          <a href="{!!route('display.buy',$buy->id)!!}" class="btn btn-success btn-sm">عرض</a>
          <a href="{!!route('edit.buy',$buy->id)!!}" type="submit" class="btn btn-primary btn-sm">تعديل</a>
           <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalPush{{$buy->id}}">مسح</button>
                    <!--Modal: modalPush-->
          <div id="modalPush{{$buy->id}}" class="modal fade">
            <div class="modal-dialog modal-confirm">
              <div class="modal-content">
                <div class="modal-header">				
                  <h4 class="modal-title">هل انت متأكد؟</h4>	
                  <button type="button"  class="btn " data-toggle="modal" data-target="#modalPush{{$buy->id}}"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                  <i class="far fa-times-circle fa-4x animated rotateIn mb-4 text-danger "></i>
                  <p>ان كنت متأكد اضغط علي مسح</p>
                </div>
                <div class="modal-footer  d-flex justify-content-center">
                  <form action="{!!route('destroy.buy')!!}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="id" value="{{$buy->id}}">
                    <button type="submit" class="btn btn-danger">مسح</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">الغاء</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div class="row d-flex justify-content-center ">
    <div >{{$buys->appends(request()->except('page'))->links()}}</div>
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
