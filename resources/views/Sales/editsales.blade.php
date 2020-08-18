@extends('adminlte::page')
@section('title','بيع')
@section('content_header')
@include('message')
  <h1><i class="fas fa-plus fa-sm text-info"></i> عملية بيع جديدة</h1>
@endsection
@section('content') 
<form class="col-md-6" action="{!!route('update.sales')!!}"  enctype="multipart/form-data" method="POST">
    @csrf
      <div class="form-group">
        <i class="fas fa-pencil-alt text-info"></i>
        <label>اسم العميل</label>
        <input type="text" class="form-control" name="name"placeholder=" اسم العميل" value="{{$sale->name}}" required>
      </div>
      <div class="form-group">
        <i class="fas fa-pencil-alt text-info"></i>
        <label>رقم الهاتف للعميل</label>
        <input type="tel" class="form-control" name="tel"placeholder=" رقم هاتف العميل" value="{{$sale->tel}}" required>
      </div>
        <div class="form-group">
            <i class="fas fa-pencil-alt text-info"></i>
            <label>وزن القطعة</label>
              <input type="number" class="form-control" step=".001" name="weight"placeholder="وزن القطعة المباعة" value="{{$sale->weight}}" required>
        </div>
      <div class="form-group">
        <label><i class="fas fa-pencil-alt text-info"></i> عيار القطعة</label>
        <select class="form-control" name="caliber" >
          @if ($sale->caliber==18)
            <option value=18 selected>18</option>
            <option value=21>21</option>
            <option value=24>24</option>
          @elseif($sale->caliber==21)
            <option value=18>18</option>
            <option value=21 selected>21</option>
            <option value=24>24</option>
          @else
            <option value=18>18</option>
            <option value=21>21</option>
            <option value=24 selected>24</option>
          @endif
                
        </select>
      </div>
      <div class="form-group">
        <label><i class="fas fa-pencil-alt text-info"></i> سعر القطعة</label>
      <input type="number" class="form-control" step=".001" name="price"placeholder="سعر القطعة المباعة" value="{{number_format($sale->price)}}"required>
      </div>
      <div class="form-group">
        <label><i class="fas fa-pencil-alt text-info"></i> نوع القطعة</label><input type="text" class="form-control" name="typetitle"placeholder="نوع القطعة المباعة" value="{{$sale->typetitle}}" required>
      </div>
      <div class="form-group">   
        <label ><i class="fas fa-image text-info "></i> نوع العملية</label>
          <select class="form-control" name="type">
            @if ($sale->type==0)
              <option value=0 selected> كاش</option>
              <option value=1>قسط</option>
            @else
              <option value=0> كاش</option>
              <option value=1 selected>قسط</option>
            @endif

          </select>    
         </div>
      <input type="hidden" name="role" value="0">
      <input type="hidden" name="id" value="{{$sale->id}}">
      <div class="form-group">
        <button type="submit" style="width:100%"class="btn btn-primary"><i class="fas fa-plus"></i> تعديل عملية البيع </button>
      </div>
  </form>
@endsection
