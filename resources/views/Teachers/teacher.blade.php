@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    المعلمين
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    المعلمين

@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


    @if ($errors->any())
        <div class="error">{{ $errors->first('name') }}</div>
    @endif



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

                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    اضافة معلم جديد
                </button>
                <br><br>

                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th> الاسم الاول </th>
                                <th>الاسم الاخير </th>
                                <th>رقم الهاتف </th>
                                <th>الايميل </th>
                                <th>المادة </th>
                                <th>الصورة الشخصية </th>
                                <th>الصفوف الدراسية</th>
                                <th>العمليات </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($teachers as $teacher)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{ $teacher->first_name }}</td>
                                    <td>{{ $teacher->last_name }}</td>
                                    <td>{{ $teacher->phone }}</td>
                                    <td>{{ $teacher->email }}</td>
                                    <td>{{ $teacher->subject->name }}</td>
                                    <td><img src="{{ $teacher->getImageUrl() }}" alt="Student Image" height="60px"
                                            width="60px"></td>
                                    <td>
                                        {{ implode(' - ', $teacher->classrooms->pluck('name')->toArray()) }}

                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $teacher->id }}" title="تعديل"><i
                                                class="fa fa-edit"></i></button>
                           
                                                        <button form="teacher{{$teacher->id}}" type="submit" class="btn btn-danger btn-sm" ><i
                                                            class="fa fa-trash"></i>
                                                        </button>
                                              
                                    </td>
                                </tr>
                                            <form id="teacher{{$teacher->id}}" action="{{ route('dashboard.teachers.destroy', $teacher->id) }}"
                                                  method="post">
                                                  {{ method_field('Delete') }}
                                                  @csrf

                                             </form>
                                <!-- edit_modal_department -->
                                <div class="modal fade" id="edit{{ $teacher->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    تعديل معلومات المعلم
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- add_form -->
                                                <form action="{{ route('dashboard.teachers.update', $teacher->id) }}"
                                                    method="post">
                                                    {{ method_field('patch') }}
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="first_name" class="mr-sm-2">الاسم الاول
                                                                :</label>
                                                            <input id="first_name" type="text" name="first_name"
                                                                class="form-control"
                                                                value=" {{ old('first_name', $teacher->first_name) }}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="last_name" class="mr-sm-2"> الاسم الاخير
                                                                :</label>
                                                            <input id="last_name" type="text" name="last_name"
                                                                class="form-control"
                                                                value="{{ old('last_name', $teacher->last_name) }}">
                                                        </div>

                                                        <div class="col">
                                                            <label for="phone" class="mr-sm-2"> رقم الهاتف
                                                                :</label>
                                                            <input id="phone" type="text" name="phone"
                                                                class="form-control"
                                                                value="{{ old('phone', $teacher->phone) }}">
                                                        </div>

                                                    </div>
                                                    <div class="row">

                                                        <div class="col">
                                                            <label for="email" class="mr-sm-2"> الايميل
                                                                :</label>
                                                            <input id="email" type="email" name="email"
                                                                class="form-control"
                                                                value="{{ old('first_name', $teacher->email) }}">
                                                        </div>


                                                    </div>
                                                    <div class="row">

                                                        <div class="col-md-6">
                                                            <label for="classroom[]">الصف <span class="text-danger">*</span></label>
                                                            <select name="classrooms[]" multiple id="classrooms[]" class="custom-select mr-sm-2">
                                                                <option disabled selected>اختر صف--</option>
                                                                @foreach($classrooms as $classroom)
                                                                    <option value="{{ $classroom->id }}" >{{ $classroom->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                        
                                                     <div class="col-md-6">
                                                   
                                                        <label for="subject_id"> المادة <span class="text-danger">*</span></label>
                                                          <select name="subject_id" id="subject_id" class="custom-select mr-sm-2">
                                                            <option disabled>اختر مادة--</option>
                                                            @foreach($subjects as $subject)
                                                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                            @endforeach
                                                            
                                                          </select>
                                                      </div>
                                                   
                                                    </div>
                                                        <div class="row">

                                                            <div class="col">
                                                                <label> صورة شخصية :<i style="color: red">jpg or
                                                                        png</i></label>
                                                                <input type="file" name="image"
                                                                    class="form-control">



                                                            </div>
                                                            <br><br>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">إغلاق</button>
                                                                <button type="submit"
                                                                    class="btn btn-success">حفظ</button>
                                                            </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- delete_modal_Grade -->
                                <div class="modal fade" id="delete{{$teacher->id}}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    هل أنت متأكد من حذف المعلم ؟
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('dashboard.teachers.destroy', $teacher->id) }}"
                                                    method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    <input id="id" type="hidden" name="id"
                                                        class="form-control" value="{{ $teacher->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">إلغاء</button>
                                                        <button type="submit" class="btn btn-danger">تأكيد</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>



    <!-- add_modal_department -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        اضافة معلم
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- add_form -->
                    <form action="{{ route('dashboard.teachers.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="Fname" class="mr-sm-2">الاسم الاول
                                    :</label>
                                <input id="Fname" type="text" name="first_name" class="form-control">
                            </div>
                            <div class="col">
                                <label for="Lname" class="mr-sm-2"> الاسم الاخير
                                    :</label>
                                <input id="Lname" type="text" name="last_name" class="form-control">
                            </div>

                            <div class="col">
                                <label for="phone" class="mr-sm-2"> رقم الهاتف
                                    :</label>
                                <input id="phone" type="text" name="phone" class="form-control">
                            </div>

                        </div>
                        <div class="row">

                            <div class="col">
                                <label for="email" class="mr-sm-2"> الايميل
                                    :</label>
                                <input id="email" type="email" name="email" class="form-control">
                            </div>
                            <div class="col">
                                <label for="password" class="mr-sm-2"> كلمة المرور
                                    :</label>
                                <input id="password" type="password" name="password" class="form-control" required>
                            </div>


                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <label for="classroom[]">الصف <span class="text-danger">*</span></label>
                                <select name="classrooms[]" multiple id="classrooms[]" class="custom-select mr-sm-2">
                                    <option disabled selected>اختر صف--</option>
                                    @foreach($classrooms as $classroom)
                                        <option value="{{ $classroom->id }}" >{{ $classroom->name }}</option>
                                    @endforeach
                                </select>
                            </div>
            
                         <div class="col-md-6">
                       
                            <label for="subject_id"> المادة <span class="text-danger">*</span></label>
                              <select name="subject_id" id="subject_id" class="custom-select mr-sm-2">
                                <option disabled>اختر مادة--</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                                
                              </select>
                          </div>
                       
                        </div>
                        <div class="col">
                            <label> صورة شخصية :<i style="color: red">jpg or
                                    png</i></label>
                            <input type="file" name="image" class="form-control">



                        </div>
                        <br><br>
                 </div>
                   <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-success">حفظ</button>
                  </div>
                </form>

            </div>
        </div>
    </div>

</div>

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
{{--<script>
    $(document).ready(function () {
        $('select[name="classroom_id"]').on('change', function () {
            var classroom_id = $(this).val();
          
            if (classroom_id) {


               
            
                $.ajax({

                    url: "{{ URL::to('dashboard/class_subjects') }}/" + classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="subject_id"]').empty();
                        $('select[name="subject_id"]').append('<option selected disabled value="">' +' ..اختر مادة'+ '</option>');
                        $.each(data, function (index, subject) {
                          
                            $('select[name="subject_id"]').append('<option value="' + subject.id + '">' + subject.name  + '</option>');
                        });

                    },
                });
            }

            else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
--}}
{{--<script>
    $(document).ready(function() {
        $('select[name="department_id"]').on('change', function() {
            var department_id = $(this).val();
            if (department_id) {

                $.ajax({

                    url: "{{ URL::to('dashboard/depclasses') }}/" + department_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="classrooms[]"]').empty();
                        $.each(data, function(key, value) {

                            $('select[name="classrooms[]"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });

                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>--}}
@endsection
