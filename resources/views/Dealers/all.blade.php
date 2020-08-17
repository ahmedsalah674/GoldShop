@extends('adminlte::page')
@section('title','جميع التجار')
@section('content_header')
@include('message')
<div>
  <h1 class="d-inline">جميع التجار</h1>
   <button type="button"  class="btn btn-warning col-md-2 ml-5" data-toggle="modal" data-target="#modalPush">اضافة تاجر جديد</button>
                    <!--Modal: modalPush-->
          <div class="modal fade" id="modalPush" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" >
            <div class="modal-dialog modal-notify modal-info" role="document" >
              <div class="modal-content text-center" >
                    
                <div class="modal-header bg-primary d-flex justify-content-center" ><!--Header-->
                  <button type="button"  class="btn text-white m-0 p-0" data-toggle="modal" data-target="#modalPush"><i class="fas fa-times "></i></button>
                  <h5 class="heading m-auto">قم بأدخال اسم التاجر و رقم هاتفه</h5>
                </div>

                <div class="modal-body"><!--Body-->
                  <i class="fas fa-edit fa-4x animated rotateIn mb-4  "style="color:#33b5e5"></i>
                  <form action="{!!route('store.dealer')!!}" method="POST">
                      @csrf
                  <input type="text" class="form-control m-1" name="name" placeholder="اسم التاجر" value="{{old('text')}}">
                  <input type="tel" class="form-control m-1" name="tel" placeholder="رقم هاتف التاجر" value="{{old('tel')}}">
                </div>

                <div class="modal-footer m-auto"><!--Footer-->
                  <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i></button>
                </div>
                </form> 
              </div>
            </div>
          </div>
</div>
@endsection
@section('content')
<input class="form-control mb-4 " id="productsTable" type="text"
      placeholder="يمكنك البحث عن العميل عن طريق الاسم او رقم الهاتف">
  
  <table class="table table-hover ">
    <thead class="text-center">
      <th>اسم التاجر</th>
      <th>رقم الهاتف</th> 
    </thead>
      <tbody id="productsTable" class="text-center">
      @foreach ($dealers as $dealer)
        <tr>
          <td>{{$dealer->name}}</td>
          <td>{{$dealer->tel}}</td>
          <td>
            <a href="{!!route('display.dealer',$dealer->id)!!}"class="btn btn-success btn-sm" >عرض</a>
            <button type="button"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#update{{$dealer->id}}">تعديل</button>
                    <!--Modal: modalPush-->
            <div class="modal fade" id="update{{$dealer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true" >
              <div class="modal-dialog modal-notify modal-info" role="document" >
                <div class="modal-content text-center" >
                      
                  <div class="modal-header bg-primary d-flex justify-content-center" ><!--Header-->
                  <button type="button"  class="btn text-white m-0 p-0" data-toggle="modal" data-target="#update{{$dealer->id}}"><i class="fas fa-times "></i></button>
                    <h5 class="heading m-auto">قم بأدخال اسم التاجر و رقم هاتفه</h5>
                  </div>

                  <div class="modal-body"><!--Body-->
                    <i class="fas fa-edit fa-4x animated rotateIn mb-4  "style="color:#33b5e5"></i>
                    <form action="{!!route('update.dealer')!!}" method="POST">
                      @csrf
                      <input type="hidden" name="dealer_id" value="{{$dealer->id}}">
                      <input type="text" class="form-control m-1" name="name" placeholder="اسم التاجر" value="{{$dealer->name}}">
                      <input type="tel" class="form-control m-1" name="tel" placeholder="رقم هاتف التاجر" value="{{$dealer->tel}}">
                  </div>

                  <div class="modal-footer m-auto"><!--Footer-->
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i></button>
                  </div>
                  </form> 
                </div>
              </div>
            </div>

          </td>
        </tr>
      @endforeach
    </tbody>  
  </table>
  <div class="row d-flex justify-content-center ">
    <div>{{$dealers->links()}}</div>
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

