@extends('adminlte::page')
@section('title','بيع ')
@section('content_header')
  <h1><i class="fas fa-plus fa-sm text-info"></i> تسجيل عملية البيع</h1>
  @include('message')
@endsection
@section('content') 
<form class="col-md-6" action="{!!route('sales.form')!!}"  enctype="multipart/form-data" method="POST">
    @csrf
      <div class="form-group">
        <i class="fas fa-pencil-alt text-info"></i>
        <label>اسم العميل</label>
        <input type="text" class="form-control" name="name"placeholder=" اسم العميل" value="{{ old('name') }}" required>
      </div>
      {{-- <div class="form-group">
        <i class="fas fa-pencil-alt text-info"></i>
        <label>رقم الهاتف للعميل</label>
        <input type="tel" class="form-control" name="tel"placeholder=" رقم هاتف العميل" value="{{ old('tel') }}" required>
      </div> --}}
        <div class="form-group">
            <i class="fas fa-pencil-alt text-info"></i>
            <label>وزن القطعة</label>
              <input type="nnumber" class="form-control" step=".001" name="weight"placeholder="وزن القطعة " value="{{ old('weight') }}" min=".01" required>
        </div>
      <div class="form-group">
        <label><i class="fas fa-pencil-alt text-info"></i> عيار القطعة</label>
        <select class="form-control" name="caliber" value="{{ old('caliber') }}">
                <option value=18>18</option>
                <option value=21>21</option>
                <option value=24>24</option>
        </select>
      </div>
      <div class="form-group">
        <label><i class="fas fa-pencil-alt text-info"></i> سعر القطعة</label>
        <input type="number" class="form-control" step=".001" name="price"placeholder="سعر القطعة " value="{{ old('price') }}" min=".01" required>
      </div>
      <div class="form-group">
        <label><i class="fas fa-pencil-alt text-info"></i> نوع القطعة</label><input type="text" class="form-control" name="typetitle"placeholder="نوع القطعة " value="{{ old('typetitle') }}" required>
      </div>
      <div class="form-group">
        <label><i class="fas fa-pencil-alt text-info"></i> نوع العملية</label>
        <select class="form-control" name="type" value="{{ old('type') }}">
                <option value=0>كاش </option>
                <option value=1>اقساط</option>
        </select>
      </div>
      <div class="form-group">
        <button type="submit" style="width:100%"class="btn btn-primary"><i class="fas fa-plus"></i> تسجيل عملية البيع </button>
      </div>
  </form>
@endsection
