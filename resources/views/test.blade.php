@extends('adminlte::page')
@section('content')
<table class="table table-hover ">
    <thead class="text-center">
      <th>اسم العميل</th>
      <th>رقم الهاتف</th>
      <th>الوزن</th>
      <th>العيار</th>
      <th>السعر</th>
      <th>نوع القطعة</th>
      <th>نوع العملية</th>
      <th>التاريخ</th>
    </thead>
      <tbody id="productsTable" class="text-center">
        <tr class="shadow " >
          <td>4185</td>
          <td>4111</td>
          <td>1515</td>
          <td>152</td>
          <td>555</td>
          <td>500</td>
          <td>قسط</td>
          <td>5116</td>
        </tr> 
        <tr   >
          <td>4185</td>
          <td>4111</td>
          <td>1515</td>
        </tr> 
    </tbody>  
  </table>
@endsection
@section('js')
    
@endsection