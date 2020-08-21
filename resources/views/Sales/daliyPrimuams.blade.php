@extends('adminlte::page')
@section('content_header')
@include('message')
    <h1>اقساط اليوم تم سدادها {{$date}}</h1>
    <h5 class="text-center">ما تم تسديده = {{number_format($day->primares,2)}} جنيه </h5>
    <div class="text-center">
        <h5 class="d-inline m-5">قم بأختيار اليوم لعرض ما تم سداده</h5>
        <form class="d-inline m-5" id="form">
        <input type="date"  name="date" id="datepicker" class="datepicker form-control w-25 d-inline" value="{{$date}}" >
        </form>
    </div>
@endsection
@section('content')
    <input class="form-control mb-4 " id="productsTable" type="text"
    placeholder="يمكنك البحث عن العميل عن طريق الاسم او رقم الهاتف">

    <table class="table table-hover ">
        <thead class="text-center">
            <th>اسم العميل</th>
            <th>رقم الهاتف</th>
            <th>وزن القطعة</th>
            <th>العيار</th>
            <th>سعر القطعة بالكامل</th>
            <th>نوع القطعة</th>
            <th>ما تم دفعه اليوم</th>
            <th>التاريخ</th>
            <th>الوقت</th>
        </thead>
        <tbody id="productsTable" class="text-center">
            @foreach ($Premiums as $Premium)
            <tr>
                <td>{{$Premium->sale->name}}</td>
                <td>{{$Premium->sale->tel}}</td>
                @if ($Premium->sale->weight >1000)
                    <td>{{round(($Premium->sale->weight /1000),4)}} كيلو</td>            
                @else
                    <td>{{round(($Premium->sale->weight),4)}} جرام</td>
                @endif
                <td>{{$Premium->sale->caliber}}</td>
                <td>{{number_format($Premium->sale->price,2)}} جنيه</td>
                <td>{{$Premium->sale->typetitle}}</td>
                <td>{{number_format($Premium->primare_sale,2)}} جنيه</td>
                <td>{{$Premium->created_at->format('d-m-Y')}}</td>
                <td>{{$Premium->created_at->format('h:i')}}</td>
            </tr>
            @endforeach
        </tbody>  
    </table>
    <div class="row d-flex justify-content-center ">
        <div class="  ">{{$Premiums->appends(request()->except('page'))->links()}}</div>
    </div>

@endsection
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    <style>
        [type="date"]::-webkit-calendar-picker-indicator {
        display: none;}
    </style>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>$( ".datepicker" ).datepicker({format: 'yyyy-mm-dd',});</script>  
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
    <script>
        $('#datepicker').on('change',function(){
            $("#form").submit();
        });
    </script>
@endsection