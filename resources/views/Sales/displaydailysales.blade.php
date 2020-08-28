@extends('adminlte::page')
@section('title','المبيعات')
@section('content_header')
@include('message')
<h1>المبيعات يوم {{$date}}</h1>
  <h5 class="text-center">ما تم بيعه = {{number_format($day->sales)}} </h5>
 <div class="text-center">
    <h5 class="d-inline m-5">قم بأختيار اليوم لعرض ما تم بيعه</h5>
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
      <th>نوع العملية</th>
      <th>التاريخ</th>
      <th>الوقت</th>
    </thead>
      <tbody id="productsTable" class="text-center">
      @foreach ($sales as $sale)
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
          @if($sale->type == 0)
            <td>كاش</td>
          @else
            <td>قسط</td>
          @endif
          <td>{{$sale->created_at->format('d-m-Y')}}</td>
          <td>{{$sale->created_at->format('h:i')}}</td>

          <td>
          <a href="{!!route('display.sales',$sale->id)!!}"class="btn btn-success btn-sm" >عرض</a>
          @if(!($sale->type && $sale->finsh)|| !$sale->type)
           
            <a href="{!!route('edit.sales',$sale->id)!!}" class="btn btn-primary btn-sm">تعديل</a>
          @endif
          <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalPush{{$sale->id}}">مسح</button>
                    <!--Modal: modalPush-->
          <div id="modalPush{{$sale->id}}" class="modal fade">
            <div class="modal-dialog modal-confirm">
              <div class="modal-content">
                <div class="modal-header">				
                  <h4 class="modal-title">هل انت متأكد؟</h4>	
                  <button type="button"  class="btn " data-toggle="modal" data-target="#modalPush{{$sale->id}}"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                  {{-- <i class="far fa-times-circle"></i> --}}
                  <i class="far fa-times-circle fa-4x animated rotateIn mb-4 text-danger "></i>
                  <p>ان كنت متأكد اضغط علي مسح</p>
                </div>
                <div class="modal-footer  d-flex justify-content-center">
                <form action="{!!route('destroy.sales')!!}" method="POST" class="d-inline">
                  @csrf
                  <input type="hidden" name="id" value="{{$sale->id}}">
                  <button type="submit" class="btn btn-danger">مسح</button>
                  <button type="button" class="btn btn-info" data-dismiss="modal">الغاء</button>
                </form>
                </div>
              </div>
            </div>
          </div>     
          
            {{-- <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalPush{{$sale->id}}">مسح</button>
                    <!--Modal: modalPush-->
              <div class="modal fade" id="modalPush{{$sale->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" >
                 <div class="modal-dialog modal-notify modal-info" role="document" >
                    <!--Content-->
                    <div class="modal-content text-center" >
                      <!--Header-->
                      <div class="modal-header bg-danger" >
                        <button type="button"  class="btn text-white" data-toggle="modal" data-target="#modalPush{{$sale->id}}"><i class="fas fa-times"></i></button>
                      </div>
                        <!--Body-->
                      <div class="modal-body">
                        <i class="fas fa-bell fa-4x animated rotateIn mb-4 "></i>
                        <p>هل انت متأكد من انك تريد المسح؟!</p>
                      </div>
                        <!--Footer-->
                      <div class="modal-footer m-auto">
                        <form action="{!!route('destroy.sales')!!}" method="POST">
                          @csrf
                          <input type="hidden" name="id" value="{{$sale->id}}">
                          <button type="submit" class="btn btn-danger "><i class="fas fa-check "></i></button>
                        </form>      
                      </div>
                    </div>
                        <!--/.Content-->
                  </div>
              </div>    --}}
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

