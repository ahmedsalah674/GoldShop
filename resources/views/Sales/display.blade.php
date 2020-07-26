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
    {{-- <tr>
     
    </tr> --}}
    <tr>
        <td>وزن القطعة: {{ $sale->weight }} جرام</td>
        <td>سعر القطعة: {{ $sale->price }} جنيه مصري</td>
    </tr>
    {{-- <tr>
      
    </tr> --}}
    <tr>
      <td>عيار القطعة: {{$sale->caliber}}</td>
      <td>نوع القطعة : {{$sale->typetitle}}</td>
    </tr>
    <tr class="text-center">
        @if ($sale->type)
            <td>نوع العملية : قسط</td>
        @else
            <td>نوع العملية : كاش</td>
        @endif
        
    </tr>
  </tbody>
</table>
<form action="{!!route('editsales')!!}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{$sale->id}}">
    <button type="submit"  class="btn btn-info col-md-6 ml-5">تعديل</a>
</form>
@endsection
