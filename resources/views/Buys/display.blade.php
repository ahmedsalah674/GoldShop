@extends('adminlte::page')
@section('title','تفاصيل عملية الشراء')
@section('content_header')
  <h1>تفاصيل عملية الشراء</h1>
@include('message')
@endsection
@section('content')
<table class="table">
  <tbody>
    
    <tr>
      <td>اسم العميل : {{ $buy->name }}</td>
      <td>هاتف العميل: {{$buy->tel}}</td>
    </tr>
    <tr>
        <td>وزن القطعة: {{ $buy->weight }} جرام</td>
        <td>سعر القطعة: {{ $buy->price }} جنيه</td>
    </tr>
    
    <tr>
      <td>عيار القطعة: {{$buy->caliber}}</td>
      <td>نوع القطعة : {{$buy->typetitle}}</td>
    </tr>
  </tbody>
</table> 
<a href="{!!route('edit.buy',$buy->id)!!}"  class="btn btn-info col-md-6 ml-5">تعديل</a>
@endsection
