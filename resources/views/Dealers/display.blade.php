@extends('adminlte::page')
@section('title','تفاصيل عن التاجر')
@section('content_header')
    <h1>تفاصيل عن التاجر</h1>
    @include('message')
@endsection
@section('content')
    <table class="table">
        <tbody>
        <tr>
            <td><b>الاسم:</b> {{ $dealer->name }}</td>
            <td><b>الهاتف:</b> {{$dealer->tel}}</td>
            <td><b>العيار:</b> {{$dealer->caliber}}</td>
            {{-- <td><b>عدد الكميات :</b> {{count($quantities)}}</td>
            <td><b>عدد الاقساط :</b> {{count($dealer->Premiums)}}</td>
            <td><b>اجمالي السعر :</b>{{number_format($quantitiess->sum('price'))}} جنيه</td> --}}

            {{-- @if($quantitiess->sum('weight') > 1000)
              <td><b>اجمالي الكمية:</b>{{round(($quantitiess->sum('weight') / 1000),4)}} كيلو</td>
            @else
              <td><b>اجمالي الكمية:</b>{{round($quantitiess->sum('weight'),4)}} جرام</td>
            @endif --}}
        </tr>
        </tbody>
    </table>
    <table class="table table-hover">
        <thead>
            <h5 class="text-center">الكميات الخاصة بالتاجر</h5>
            <th>#</th>
            <th>حجم الكمية</th>
            <th>الاجرة</th>
            {{-- <th>العيار</th> --}}
            {{-- <th>وصف</th> --}}
            <th>التاريخ</th>
            <th>الوقت</th>
            <th></th>
        </thead>
        <tbody>
        @foreach ($quantities as $index => $quantity)
        <tr>
            <td>{{++$index}}</td>
            @if($quantity->weight > 1000)
              <td>{{ round(($quantity->weight /1000),4)}} كيلو</td>
            @else
              <td>{{ round(($quantity->weight),4)}} جرام</td>
            @endif
            <td>{{ number_format($quantity->price,2)}} جنيه</td>
            {{-- <td>{{ $quantity->caliber}}</td> --}}
            {{-- <td>{{ $quantity->typetitle}}</td> --}}
            <td>{{ $quantity->created_at->format('d-m-Y')}}</td>
            <td>{{ $quantity->created_at->format('h:i')}}</td>
            <td>
            <button type="button"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{$quantity->id}}">تعديل</button>
              <!--Modal: modalPush-->
            <div class="modal fade" id="edit{{$quantity->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false" >
              <div class="modal-dialog modal-notify modal-info" role="document" >
                <div class="modal-content text-center" >                      
                  <div class="modal-header bg-primary d-flex justify-content-center" ><!--Header-->
                    <button type="button"  class="btn text-white m-0 p-0" data-toggle="modal" data-target="#edit{{$quantity->id}}"><i class="fas fa-times "></i></button>
                    <h5 class="heading m-auto">قم بتعديل قيمة الكمية</h5>
                  </div>
                  <div class="modal-body"><!--Body-->
                    <i class="fas fa-edit fa-4x animated rotateIn mb-4  "style="color:#33b5e5"></i>
                    <form action="{!!route('update.quantity.dealer')!!}" method="POST">
                        @csrf
                        <input type="number" class="form-control" placeholder="قم بأدخال القمية المراد تسجيلها" step=".01" name="weight" min="1"  >
                        <input type="number" class="form-control" placeholder="قم بأدخال القمية المراد تسجيلها" step=".01" name="price" min="1" >
                        
                      <div class="modal-footer m-auto"><!--Footer-->
                        <input type="hidden" name="id" value="{{$quantity->id}}">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i></button>
                      </div>
                    </form> 
                  </div>
                </div>
              </div>
            </div>
            <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$quantity->id}}">مسح</button>
              <!--Modal: modalPush-->
            <div id="delete{{$quantity->id}}" class="modal fade">
              <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                  <div class="modal-header">				
                    <h4 class="modal-title">هل انت متأكد؟</h4>	
                    <button type="button"  class="btn " data-toggle="modal" data-target="#delete{{$quantity->id}}"><i class="fas fa-times"></i></button>
                  </div>
                  <div class="modal-body text-center">
                    {{-- <i class="far fa-times-circle"></i> --}}
                    <i class="far fa-times-circle fa-4x animated rotateIn mb-4 text-danger "></i>
                    <p>ان كنت متأكد اضغط علي مسح</p>
                  </div>
                  <div class="modal-footer  d-flex justify-content-center">
                    <form action="{!!route('destroy.quantity.dealer')!!}" method="POST" class="d-inline">
                      @csrf
                      <input type="hidden" name="id" value="{{$quantity->id}}">
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
        @if(!count($quantities))
            <tr>
                <td></td>
                <td></td>
                <td class="text-center"><h5>لا يوجد  كميات  تخص هذا التاجر</h5> </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                
            </tr>
        @endif
        </tbody>
        <tfoot class="card-footer text-muted">
        @if (count($quantities))
            <tr>
              {{-- <td>اجمالي ما تم سداده من مال</td> --}}
              {{-- <td>{{number_format($dealer->Premiums->sum('premium_price'))}} جنيه</td> --}}
              <td></td>
              <td></td>
              <td>المتبقي من مال و لم يتم سداده</td>
              <td>{{number_format( ($quantitiess->sum('price') - $dealer->Premiums->sum('premium_price')) ,2)}} جنيه</td>
              <td></td>
              <td></td>

          </tr>
          <tr>
            {{-- <td>اجمالي ما تم سداده من دهب</td>
            @if ($dealer->Premiums->sum('weight') <1000)
              <td>{{round(($dealer->Premiums->sum('weight')),4)}} جرام</td>
            @else
             <td>{{round(($dealer->Premiums->sum('weight') /1000),4)}} كيلو</td>  
            @endif --}}
            <td></td>
            <td></td>
            <td>المتبقي من الدهب و لم يتم سداده</td>
            @if (($quantitiess->sum('weight') - $dealer->Premiums->sum('premium_gold')) < 1000)
              <td>{{round(($quantitiess->sum('weight') - $dealer->Premiums->sum('premium_gold')),4)}}جرام</td>
            @else
              <td>{{round((($quantitiess->sum('weight') - $dealer->Premiums->sum('premium_gold')) / 1000), 4)}}كيلو</td>  
            @endif
            
            <td></td>
            <td></td>
        </tr>
        @endif
        </tfoot>  
    </table>
    <div class="row d-flex justify-content-center ">
      <div>{{$quantities->links()}}</div>
    </div>
  <div class="text-center">
      <button type="button"  class="btn btn-warning col-md-4" data-toggle="modal" data-target="#quntitiy">اضافة كمية</button>
                    <!--Modal: modalPush-->
          <div class="modal fade" id="quntitiy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" >
            <div class="modal-dialog modal-notify modal-info" role="document" >
              <div class="modal-content text-center" >
                    
                <div class="modal-header bg-primary d-flex justify-content-center" ><!--Header-->
                  <button type="button"  class="btn text-white m-0 p-0" data-toggle="modal" data-target="#quntitiy"><i class="fas fa-times "></i></button>
                  <h5 class="heading m-auto">قم بأدخال تفاصيل الكمية المراد تسجيلها</h5>
                </div>

                <div class="modal-body"><!--Body-->
                  <i class="fas fa-edit fa-4x animated rotateIn mb-4  "style="color:#33b5e5"></i>
                  <form action="{!!route('store.quantity')!!}" method="POST">
                      @csrf
                    <input type="number" class="form-control m-1" step=".001" name="weight" value="{{old('weight')}}" placeholder="قم بأدخال الوزن المراد تسجيله"min="1" required>
                    <input type="number" class="form-control m-1" step=".001" name="price" value="{{old('price')}}" placeholder="قم بأدخال الاجرة " min="1" required>
                    {{-- <select name="caliber" class="form-control m-1">
                        <option value="18">18</option>
                        <option value="21">21</option>
                        <option value="24">24</option>
                    </select> --}}
                    {{-- <input type="text" class="form-control m-1" name="typetitle" value="{{old('typetitle')}}" placeholder="وصف للكمية"> --}}
                    <input type="hidden" name="dealer_id" value="{{$id}}">
                </div>

                  <div class="modal-footer m-auto"><!--Footer-->
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i></button>
                  </div>
                  </form> 
              </div>
            </div>
          </div>
        @if(count($quantities))
        <button type="button"  class="btn btn-secondary col-md-4" data-toggle="modal" data-target="#Premiums">اضافة قسط</button>
                    <!--Modal: modalPush-->
          <div class="modal fade" id="Premiums" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" >
            <div class="modal-dialog modal-notify modal-info" role="document" >
              <div class="modal-content text-center" >
                    
                <div class="modal-header bg-primary d-flex justify-content-center" ><!--Header-->
                  <button type="button"  class="btn text-white m-0 p-0" data-toggle="modal" data-target="#Premiums"><i class="fas fa-times "></i></button>
                  <h5 class="heading m-auto">قم بأدخال تفاصيل القسط المراد تسجيله</h5>
                </div>

                <div class="modal-body"><!--Body-->
                  <i class="fas fa-edit fa-4x animated rotateIn mb-4  "style="color:#33b5e5"></i>
                  <p class="text-center"> الحد الاقصي للقسط من المال {{number_format($quantitiess->sum('price') - $dealer->Premiums->sum('premium_price'))}} جنيه </p>
                  @if (round(($quantitiess->sum('weight') - $dealer->Premiums->sum('premium_gold')),4) > 1000)
                    <p class="text-center"> الحد الاقصي للقسط من الدهب {{round(($quantitiess->sum('weight') - $dealer->Premiums->sum('premium_gold'))/1000,4)}} كيلو </p>     
                  @else
                    <p class="text-center"> الحد الاقصي للقسط من الدهب {{round(($quantitiess->sum('weight') - $dealer->Premiums->sum('premium_gold')),4)}} جرام </p>  
                  @endif
                  <form action="{!!route('store.Premiums')!!}" method="POST">
                      @csrf
                    <input type="number" class="form-control m-1" step=".001" name="premium_price" value="{{old('premium_price')}}" placeholder="قم بأدخال ما تم دفعه من مال">
                  <input type="number" class="form-control m-1" step=".001" name="premium_gold" value="{{old('premium_gold')}}" placeholder="قم بأدخال كمية الدهب " >
                    <input type="hidden" name="dealer_id" value="{{$id}}">
                </div>

                  <div class="modal-footer m-auto"><!--Footer-->
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i></button>
                  </div>
                  </form> 
              </div>
            </div>
          </div>
            @if(count($dealer->Premiums))
              <a href="{!!route('display.Premiums',$id)!!}" class="btn btn-primary col-md-4 m-1">عرض الاقساط</a>
            @endif
          @endif

</div>
@endsection
