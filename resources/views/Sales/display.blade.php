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
        <td>هاتف العميل: {{$sale->tel}}</td>
      </tr>

      <tr>
          <td>وزن القطعة: {{ $sale->weight }} جرام</td>
          <td>سعر القطعة: {{ $sale->price }} جنيه مصري</td>
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
          <td><b>لم يتم التسديد الاقساط</b></td>
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
      </thead
      <tbody>
        @foreach ($primares as $index => $primare)
        <tr>
          <td>{{++$index}}</td>
          <td>{{ $primare->primare_sale }} جنيه</td>
          <td>{{$primare->created_at}}</td>
        </tr>
        @endforeach
        @if(!count($primares))
          <tr>
            <td></td>
            <td class="text-center"><h5>لم يتم تسديد اي قسط حتي الان</h5> </td>
          </tr>
        @endif
      </tbody>
      <tfoot class="card-footer text-muted">
        @if (count($primares))
            <tr>
              <td>اجمالي الاقساط</td>
            <td>{{$primares->sum('primare_sale')}} جنيه</td>
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
                  <p>المبلغ المتبقي هو {{$sale->price-$primares->sum('primare_sale')}} جنيه</p>
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
                <form action="{!!route('edit.sales')!!}" method="POST" class="d-inline">
                  @csrf
                  <input type="hidden" name="id" value="{{$sale->id}}">
                  <button type="submit"  class="btn btn-info col-md-4">تعديل</a>  
                </form>
      @endif
</div>
@endsection
