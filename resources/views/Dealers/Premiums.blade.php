@extends('adminlte::page')
@section('title','اقساط')
@section('content_header')
@include('message')
  <h1 class="d-inline">اقساط</h1>
@endsection
@section('content')
<input class="form-control mb-4 " id="productsTable" type="text"
      placeholder="يمكنك البحث عن القسط عن طريق المبلغ او التاريخ بصيغة 2020-01-03">
  
  <table class="table table-hover ">
    <thead class="text-center">
      <th>الوزن</th>
      <th>المبلغ</th> 
      <th>التاريخ</th> 
      <th>الوقت</th> 
    </thead>
      <tbody id="productsTable" class="text-center">
      @foreach ($Premiums as $Premium)
        <tr>
          <td>{{$Premium->premium_price}}</td>
          <td>{{$Premium->premium_gold}}</td>
          <td>{{$Premium->created_at->format('d-m-Y')}}</td>
          <td>{{$Premium->created_at->format('h:i')}}</td>
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

