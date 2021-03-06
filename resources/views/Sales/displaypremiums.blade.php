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
      {{-- <th>رقم الهاتف</th> --}}
      <th>الوزن</th>
      <th>العيار</th>
      <th>السعر</th>
      <th>نوع القطعة</th>
      <th>نوع العملية</th>
      <th>التاريخ</th>
      <th>الوقت</th>
      <th></th>
    </thead>
      <tbody id="productsTable" class="text-center">
      @foreach ($sales as $sale)
        @if ($sale->role)
            @continue
        @endif
          <tr>
            <td>{{$sale->name}}</td>
            {{-- <td>{{$sale->tel}}</td> --}}
            @if ($sale->weight >1000)
              <td>{{round(($sale->weight /1000),4)}} كيلو</td>
            @else
              <td>{{round(($sale->weight),4)}} جرام</td>
            @endif
            <td>{{$sale->caliber}}</td>
            <td>{{number_format($sale->price)}} جنيه</td>
            <td>{{$sale->typetitle}}</td>
            <td>قسط</td>
            <td>{{$sale->created_at->format('Y-m-d')}}</td>
            <td>{{$sale->created_at->format('h:i')}}</td>
            <td>
             <a href="{!!route('display.sales',$sale->id)!!}"class="btn btn-success btn-sm">عرض</a>
             <a href="{!!route('edit.sales', $sale->id)!!}" class="btn btn-primary btn-sm">تعديل</a>
             <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$sale->id}}">مسح</button>
                    <!--Modal: modalPush-->
              <div id="delete{{$sale->id}}" class="modal fade">
                <div class="modal-dialog modal-confirm">
                  <div class="modal-content">
                    <div class="modal-header">				
                      <h4 class="modal-title">هل انت متأكد؟</h4>	
                      <button type="button"  class="btn " data-toggle="modal" data-target="#delete{{$sale->id}}"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="modal-body text-center">
                      <i class="far fa-times-circle fa-4x animated rotateIn mb-4 text-danger "></i>
                      <p>ان كنت متأكد اضغط علي مسح</p>
                    </div>
                    <div class="modal-footer  d-flex justify-content-center">
                      <form action="{!!route('destroy.sales')!!}" method="POSt" class="d-inline">
                        @csrf
                        <input type="hidden" name="id" value="{{$sale->id}}">
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
    <div class="  ">{{$sales->appends(request()->except('page'))->links()}}</div>
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

