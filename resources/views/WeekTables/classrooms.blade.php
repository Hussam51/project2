@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    الصفوف الدراسية
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
 برنامج الدوام/ الصفوف الدراسية
@section('PageTitle')
    الصفوف الدراسية
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row" >

    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

              
                <br><br>

                <div class="table-responsive">
                   

                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                            data-page-length="50" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>إسم الصف</th>
                                    <th>القسم</th>
                                    <th>برنامج الدوام</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>

                                @foreach ($classrooms as $classroom)
                                    <tr>
                                        <?php $i++; ?>
                                        <td>{{ $i }}</td>
                                        <td>{{ $classroom->name }}</td>
                                        <td>{{ $classroom->department->name }}</td>
                                        <td class="att">
                                            <a href="{{route('dashboard.week_tables.show',$classroom->id)}}" style="color: rgb(255, 255, 255);background-color: rgb(35, 107, 6)" class="fa-sm"> عرض جدول الدوام   </a>
                                        </td>
                                    </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                      


                </div>
            </div>



        </div>

    </div>
   
</div>
<!-- row closed -->
@endsection
@section('js')

@toastr_js
@toastr_render
@endsection