@extends('adminlte::page')
@section('title','تجار')
@section('content_header')
  <h1><i class="fas fa-plus fa-sm text-info"></i> كمية جديدة</h1>
@endsection
@section('content') 
<form class="col-md-6" action="{!!route('storebuy')!!}" method="POST"  enctype="multipart/form-data">
    @csrf
      <div class="form-group">
        <i class="fas fa-pencil-alt text-info"></i>
        <label>اسم التاجر</label>
        <input type="text" class="form-control" name="name"placeholder=" اسم التاجر" value="{{ old('name') }}" required>
      </div>
      <div class="form-group">
        <i class="fas fa-pencil-alt text-info"></i>
        <label>رقم الهاتف للعميل</label>
        <input type="tel" class="form-control" name="tel"placeholder=" رقم هاتف التاجر" value="{{ old('tel') }}" required>
      </div>
        <div class="form-group">
            <i class="fas fa-pencil-alt text-info"></i>
            <label>وزن القطعة</label>
              <input type="number" class="form-control" step=".001" name="weight"placeholder="وزن الكمية " value="{{ old('weight') }}" required>
        </div>
      <div class="form-group">
        <label><i class="fas fa-pencil-alt text-info"></i> عيار الكمية</label>
        <select class="form-control" name="caliber">
                <option value=18>18</option>
                <option value=21>21</option>
                <option value=24>24</option>
        </select>
      </div>
      <div class="form-group">
        <label><i class="fas fa-pencil-alt text-info"></i> الأجرة</label>
        <input type="number" class="form-control" step=".001" name="price"placeholder="الأجرة " value="{{ old('price') }}"required>
      </div>
      <div class="form-group">
        <label><i class="fas fa-pencil-alt text-info"></i> وصف الكمية</label><input type="text" class="form-control" name="typetitle"placeholder="وصف الكمية" value="{{ old('typetitle') }}" required>
      </div>
      <div class="form-group">
        <button type="submit" style="width:100%"class="btn btn-primary"><i class="fas fa-plus"></i> تسجيل الكمية الجديدة </button>
      </div>
  </form>
@endsection
