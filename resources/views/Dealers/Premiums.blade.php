@extends('adminlte::page')
@section('title','اقساط')
@section('content_header')
@include('message')
  <h1 class="d-inline">الاقساط</h1>
@endsection
@section('content')
<input class="form-control mb-4 " id="productsTable" type="text"
      placeholder="يمكنك البحث عن القسط عن طريق المبلغ او التاريخ بصيغة 2020-01-03">
  
  <table class="table table-hover ">
    <thead class="text-center">
      <th>المبلغ</th>
      <th>الوزن</th> 
      <th>التاريخ</th> 
      <th>الوقت</th> 
    </thead>
      <tbody id="productsTable" class="text-center">
      @foreach ($Premiums as $Premium)
        <tr>
          <td>{{number_format($Premium->premium_price,2)}}جنيه</td>
          @if($Premium->premium_gold > 1000)
            <td>{{round(($Premium->premium_gold /1000),4)}}جرام</td>
          @else
            <td>{{round(($Premium->premium_gold),4)}}جرام</td>
          @endif
          <td>{{$Premium->created_at->format('d-m-Y')}}</td>
          <td>{{$Premium->created_at->format('h:i')}}</td>
          <td>
            <button type="button"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{$Premium->id}}">تعديل</button>
              <!--Modal: modalPush-->
            <div class="modal fade" id="edit{{$Premium->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false" >
              <div class="modal-dialog modal-notify modal-info" role="document" >
                <div class="modal-content text-center" >                      
                  <div class="modal-header bg-primary d-flex justify-content-center" ><!--Header-->
                    <button type="button"  class="btn text-white m-0 p-0" data-toggle="modal" data-target="#edit{{$Premium->id}}"><i class="fas fa-times "></i></button>
                    <h5 class="heading m-auto">قم بتعديل قيمة الكمية</h5>
                  </div>
                  <div class="modal-body"><!--Body-->
                    <i class="fas fa-edit fa-4x animated rotateIn mb-4  "style="color:#33b5e5"></i>
                    <form action="{!!route('update.dealer.Premiums')!!}" method="POST">
                        @csrf
                        <input type="number" class="form-control" placeholder="قم بأدخال القمية المراد تسجيلها" step=".01" name="weight" min="1"  >
                        <input type="number" class="form-control" placeholder="قم بأدخال القمية المراد تسجيلها" step=".01" name="price" min="1" >
                        
                      <div class="modal-footer m-auto"><!--Footer-->
                        <input type="hidden" name="id" value="{{$Premium->id}}">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i></button>
                      </div>
                    </form> 
                  </div>
                </div>
              </div>
            </div>
            <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$Premium->id}}">مسح</button>
              <!--Modal: modalPush-->
            <div id="delete{{$Premium->id}}" class="modal fade">
              <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                  <div class="modal-header">				
                    <h4 class="modal-title">هل انت متأكد؟</h4>	
                    <button type="button"  class="btn " data-toggle="modal" data-target="#delete{{$Premium->id}}"><i class="fas fa-times"></i></button>
                  </div>
                  <div class="modal-body text-center">
                    {{-- <i class="far fa-times-circle"></i> --}}
                    <i class="far fa-times-circle fa-4x animated rotateIn mb-4 text-danger "></i>
                    <p>ان كنت متأكد اضغط علي مسح</p>
                  </div>
                  <div class="modal-footer  d-flex justify-content-center">
                    <form action="{!!route('destroy.dealer.Premiums')!!}" method="POST" class="d-inline">
                      @csrf
                      <input type="hidden" name="id" value="{{$Premium->id}}">
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
    <div>{{$Premiums->links()}}</div>
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

