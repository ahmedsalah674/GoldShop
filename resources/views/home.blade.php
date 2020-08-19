@extends('adminlte::page')
@section('content')
@include('message')
<div class="container ">
    <div class="row justify-content-center ">
        <div class="col-md-8 ">
            <div class="card  ">
                
                <div class="card-header bg-primary rounded text-center">
                        <b>ايراد اليوم = المتبقي + البيع اليومى - الشراءاليومى</b>
                </div>

                <div class="text-center car-title mt-2">
                    <h5 class="d-inline m-5">قم بأختيار اليوم لعرض التفاصيل</h5>
                    <form class="d-inline m-5" id="form">
                    <input type="date"  name="date" id="datepicker" class="datepicker form-control w-25 d-inline" value="{{$date}}" >
                    </form>
                </div>
                @if ($date!=null)
                <div class="text-center car-title mt-3">
                    <h5 class="d-inline m-5">التاريخ: {{$date}}</h5>
                </div>
                @endif
                
                <div class="card-body">
                    <table class="m-auto">
                        <tr class="text-center ">
                            <td>المتبقى</td>
                            <td> + </td>
                            <td>البيع اليومى</td>
                            <td> - </td>
                            <td>الشراء اليومى</td>
                            <td> = </td>
                            <td>المجموع</td>
                        </tr>
                        
                        <tr class="text-center "> 
                            <td>{{number_format($day->stay)}}</td>
                            <td>+</td>
                            <td>{{number_format($day->sales)}}</td>
                            <td>-</td>
                            <td>{{number_format($day->buys)}}</td> 
                            <td> = </td>
                            @if ($day->total < 0)
                                <td><b>{{number_format($day->total * -1)}}- جنيه</b></td>
                            @else
                                <td><b>{{number_format($day->total)}} جنيه</b></td>
                            @endif
                        </tr>
                    </table>
                </div>
                @if ($day->total < 0)
                    <div class="text-center">
                        تم شراء بمبلغ <b>{{number_format($day->total * -1)}}- جنيه</b> من خارج الايراد حتي الان و سيتم خصصم المبلغ
                    </div>    
                @endif
                
                
            </div>
        @if($date == null)
            <button type="button"  class="form-control btn btn-warning text-body" data-toggle="modal" data-target="#modalPush">قم بتغير القيمة المتبقية</button>
                <!--Modal: modalPush-->
            <div class="modal fade" id="modalPush" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false" >
                <div class="modal-dialog modal-notify modal-info" role="document" >
                    <div class="modal-content text-center" >
                      
                      <div class="modal-header bg-primary d-flex justify-content-center" ><!--Header-->
                        <button type="button"  class="btn text-white m-0 p-0" data-toggle="modal" data-target="#modalPush"><i class="fas fa-times "></i></button>
                        <h5 class="heading m-auto">قم بأدخال القيمة المراد تسجيلها</h5>
                      </div>

                      <div class="modal-body"><!--Body-->
                        <i class="fas fa-edit fa-4x animated rotateIn mb-4  "style="color:#33b5e5"></i>
                        <form action="{!!route('update.stay')!!}" method="POST">
                            @csrf
                            <input type="number" class="form-control" placeholder="قم بأدخال القمية المراد تسجيلها" step=".01" name="stay">
                      </div>

                      <div class="modal-footer m-auto"><!--Footer-->
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i></button>
                      </div>
                        </form> 
                    </div>
                  </div>
            </div>
        @else
            <div class="text-center">
                <a href="{!!route('home')!!}" class="btn btn-info text-body ">ايراد اليوم</a>
            </div>
        @endif
        </div>
    </div>
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
        $('#datepicker').on('change',function(){
            $("#form").submit();
        });
    </script> 
@endsection 

