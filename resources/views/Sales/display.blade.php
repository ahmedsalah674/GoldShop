@extends('adminlte::page')
@section('title','تفاصيل عملية البيع')
@section('content_header')
  <h1>تفاصيل عمليةالبيع</h1>
  @include('message')
@endsection
@section('content')
<table class="table">
    <tbody>
      <tr>
        <td>اسم العميل : {{ $sale->name }}</td>
        {{-- <td>هاتف العميل: {{$sale->tel}}</td> --}}
      </tr>

      <tr>
        @if (round(($sale->weight),4)>1000 )
          <td>وزن القطعة: {{ round(($sale->weight /1000),4) }} جرام</td>
        @else
          <td>وزن القطعة: {{ round(($sale->weight),4) }} جرام</td>
        @endif
          <td>سعر القطعة: {{ number_format($sale->price) }} جنيه</td>
      </tr>

      <tr>
        <td>عيار القطعة: {{$sale->caliber}}</td>
        <td>نوع القطعة : {{$sale->typetitle}}</td>
      </tr>
      
      <tr>  
        @if (!$sale->type)
          <td>نوع العملية : كاش</td>
        @else
          <td>نوع العملية : قسط</td>
        @endif
        @if ($sale->type && $sale->finsh)
          <td><b>تم تسديد القسط بالكامل</b> </td>
        @elseif($sale->type && !$sale->finsh)
          <td><b>لم يتم تسديد المبلغ حتي الان</b></td>
        @endif
      </tr>
      
    </tbody>
  </table>
  @if ($sale->type)
    <table class="table table-hover">
      <thead>
        <h5 class="text-center">الاقساط التي تم تسديدها حتي الان</h5>
        <th>#</th>
        <th>المبلغ المدفوع</th>
        <th>التاريخ</th>
        <th>الوقت</th>
        <th></th>
      </thead
      <tbody>
        @foreach ($primares as $index => $primare)
        <tr>
          <td>{{++$index}}</td>
          <td>{{ number_format($primare->primare_sale) }} جنيه</td>
          <td>{{$primare->created_at->format('Y-m-d')}}</td>
          <td>{{$primare->created_at->format('h:i')}}</td>
          <td>
          @if(!$sale->finsh)
          <button type="button"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{$primare->id}}">تعديل</button>
          @endif    <!--Modal: modalPush-->
            <div class="modal fade" id="edit{{$primare->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false" >
                <div class="modal-dialog modal-notify modal-info" role="document" >
                  <div class="modal-content text-center" >
                      
                    <div class="modal-header bg-primary d-flex justify-content-center" ><!--Header-->
                      <button type="button"  class="btn text-white m-0 p-0" data-toggle="modal" data-target="#edit{{$primare->id}}"><i class="fas fa-times "></i></button>
                      <h5 class="heading m-auto">قم بتعديل قيمة القسط</h5>
                    </div>

                    <div class="modal-body"><!--Body-->
                      <i class="fas fa-edit fa-4x animated rotateIn mb-4  "style="color:#33b5e5"></i>
                      <form action="{!!route('Premiums.update')!!}" method="POST">
                          @csrf
                          <input type="number" class="form-control" placeholder="قم بأدخال القمية المراد تسجيلها" step=".01" name="primare_sale" min="1" max="{{$sale->price - $primares->sum('primare_sale') + $primare->primare_sale }}" required >
                          
                        <div class="modal-footer m-auto"><!--Footer-->
                          <input type="hidden" name="id" value="{{$primare->id}}">
                          <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i></button>
                        </div>
                      </form> 
                    </div>
                </div>
              </div>
            </div>
          @if(!$sale->finsh)
            <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$primare->id}}">مسح</button>
          @endif          <!--Modal: modalPush-->
            <div id="delete{{$primare->id}}" class="modal fade">
              <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                  <div class="modal-header">				
                    <h4 class="modal-title">هل انت متأكد؟</h4>	
                    <button type="button"  class="btn " data-toggle="modal" data-target="#delete{{$primare->id}}"><i class="fas fa-times"></i></button>
                  </div>
                  <div class="modal-body text-center">
                    {{-- <i class="far fa-times-circle"></i> --}}
                    <i class="far fa-times-circle fa-4x animated rotateIn mb-4 text-danger "></i>
                    <p>ان كنت متأكد اضغط علي مسح</p>
                  </div>
                  <div class="modal-footer  d-flex justify-content-center">
                    <form action="{!!route('Premiums.destroy')!!}" method="POST" class="d-inline">
                      @csrf
                      <input type="hidden" name="id" value="{{$primare->id}}">
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
        @if(!$sale->finsh && (!count($primares)&& !$sale->finsh))
          <tr>
            <td></td>
            <td class="text-center"><h5>لم يتم تسديد اي قسط حتي الان</h5> </td>
            <td></td>
            <td></td>
          </tr>
          @elseif(!count($primares))
            <tr>
              <td></td>
              <td class="text-center"><h5>تم تسديد القسط</h5> </td>
              <td></td>
              <td></td>
            </tr>
        @endif
      </tbody>
      <tfoot class="card-footer text-muted">
        @if (count($primares))
            <tr>
              <td></td>
              <td></td> 
              <td>اجمالي الاقساط</td>
              <td>{{number_format($primares->sum('primare_sale'))}} جنيه</td>
              <td></td>
            </tr>
        @endif
      </tfoot>  
    </table>
  @endif
  <div class="text-center">
      @if ($sale->type &&!$sale->finsh )

        <button type="button"  class="btn btn-warning col-md-4" data-toggle="modal" data-target="#modalPush">اضافة قسط</button>
                    <!--Modal: modalPush-->
          <div class="modal fade" id="modalPush" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" >
            <div class="modal-dialog modal-notify modal-info" role="document" >
              <div class="modal-content text-center" >
                    
                <div class="modal-header bg-primary d-flex justify-content-center" ><!--Header-->
                  <button type="button"  class="btn text-white m-0 p-0" data-toggle="modal" data-target="#modalPush"><i class="fas fa-times "></i></button>
                  <h5 class="heading m-auto">قم بأدخال القيمة المراد تسجيلها</h5>
                </div>

                <div class="modal-body"><!--Body-->
                  <i class="fas fa-edit fa-4x animated rotateIn mb-4  "style="color:#33b5e5"></i>
                  <form action="{!!route('premare.add')!!}" method="POST">
                      @csrf
                  <p>المبلغ المتبقي هو {{number_format($sale->price-$primares->sum('primare_sale'))}} جنيه</p>
                  <input type="hidden" name="dealing_id" value="{{$sale->id}}">
                      <input type="number" class="form-control" placeholder="قم بأدخال القمية المراد تسجيلها" step=".01" name="primare" max="{{$sale->price-$primares->sum('primare_sale')}}">
                </div>

                  <div class="modal-footer m-auto"><!--Footer-->
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i></button>
                  </div>
                  </form> 
              </div>
            </div>
          </div>
      @endif
      @if(!($sale->type && $sale->finsh)) 
        <a href="{!!route('edit.sales',$sale->id)!!}"  class="btn btn-info col-md-4">تعديل</a>  
      @endif
</div>
@endsection