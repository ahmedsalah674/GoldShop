@extends('adminlte::page')

@section('content')
<div class="container ">
    <div class="row justify-content-center ">
        <div class="col-md-8 ">
            <div class="card  ">
                <div class="card-header bg-primary rounded "><b>ايراد اليوم = المتبقي +البيع اليومى - الشراءاليومى</b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table>
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
                            <td>200</td>
                            <td>+</td>
                            <td>1000</td>
                            <td>-</td>
                            <td>100</td> 
                            <td> = </td>
                            <td>1100</td>
                        </tr>
                        
                    </table>
                </div>
                
            </div>
            <div>
                <form action="">
                    <button type="submit" class="form-control btn btn-warning text-white">بدأ يوم جديد</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
