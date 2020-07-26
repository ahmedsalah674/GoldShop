@extends('adminlte::page')
@section('title','تعديل')
@section('content_header')
  <h1><i class="fas fa-plus fa-sm text-info"></i>تعديل عملية الشراء</h1>
@endsection
@section('content') 
<form class="col-md-6" action=""  enctype="multipart/form-data">
    @csrf
      <div class="form-group">
        <i class="fas fa-pencil-alt text-info"></i>
        <label>اسم العميل</label>
        <input type="text" class="form-control" name="name"placeholder=" اسم العميل" value="{{$buy->name}}" required>
      </div>
      <div class="form-group">
        <i class="fas fa-pencil-alt text-info"></i>
        <label>رقم الهاتف للعميل</label>
        <input type="tel" class="form-control" name="tel"placeholder=" رقم هاتف العميل" value="{{$buy->tel}}" required>
      </div>
        <div class="form-group">
            <i class="fas fa-pencil-alt text-info"></i>
            <label>وزن القطعة</label>
              <input type="nnumber" class="form-control" step=".001" name="weight"placeholder="وزن القطعة المباعة" value="{{$buy->weight}}" required>
        </div>
      <div class="form-group">
        <label><i class="fas fa-pencil-alt text-info"></i> عيار القطعة</label>
        <select class="form-control" name="caliber" >
          @if ($buy->caliber==18)
            <option value=18 selected>18</option>
            <option value=21>21</option>
            <option value=24>24</option>
          @elseif($buy->caliber==21)
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
        <input type="number" class="form-control" step=".001" name="price"placeholder="سعر القطعة المباعة" value="{{$buy->price}}"required>
      </div>
      <div class="form-group">
        <label><i class="fas fa-pencil-alt text-info"></i> نوع القطعة</label><input type="text" class="form-control" name="typetitle"placeholder="نوع القطعة المباعة" value="{{$buy->typetitle}}" required>
      </div>
      <input type="hidden" name="type" value="0">
      <input type="hidden" name="role" value="1">
      <div class="form-group">
        <button type="submit" style="width:100%"class="btn btn-primary"><i class="fas fa-plus"></i> تعديل عملية الشراء </button>
      </div>
  </form>
@endsection
