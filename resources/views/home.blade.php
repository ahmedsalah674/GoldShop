@extends('adminlte::page')
@section('content')
@include('message')
<div class="container ">
    <div class="row justify-content-center ">
        <div class="col-md-8 ">
            <div class="card  ">
                <div class="card-header bg-primary rounded text-center">
                        <b>ايراد اليوم = المتبقي +البيع اليومى - الشراءاليومى</b>
                </div>

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
                            <td>{{$day->stay}}</td>
                            <td>+</td>
                            <td>{{$day->sales}}</td>
                            <td>-</td>
                            <td>{{$day->buys}}</td> 
                            <td> = </td>
                            <td>{{$day->total}}</td>
                        </tr>
                    </table>
                </div>
                
            </div>

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
        </div>
    </div>
</div>
@endsection
