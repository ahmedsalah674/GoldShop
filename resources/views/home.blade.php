@extends('adminlte::page')

@section('content')
<div class="container ">
    <div class="row justify-content-center ">
        <div class="col-md-8 ">
            <div class="card  ">
                <div class="card-header bg-primary rounded text-center">
                        <b>ايراد اليوم = المتبقي +البيع اليومى - الشراءاليومى</b>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="m-auto">
                        <tr class="text-center ">
                            <td>المتبقى</td>
                            <td> + </td>
                            <td>البيع اليومى</td>
                            <td> - </td>
                            <td>الشراء اليومى</td>
                            <td> = </td>
                            <td>المجموع</td>
                        </tr>
                        
                        <tr class="text-center "> 
                            <td>{{$day->stay}}</td>
                            <td>+</td>
                            <td>{{$day->sales}}</td>
                            <td>-</td>
                            <td>{{$day->buys}}</td> 
                            <td> = </td>
                            <td>{{$day->total}}</td>
                        </tr>
                    </table>
                </div>
                
            </div>
            <div>
                <form action="">
                    <button type="submit" class="form-control btn btn-warning text-white">قم بتغير القيمة المتبقية</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
