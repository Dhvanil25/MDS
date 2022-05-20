@extends('admin.layout')
@section('content')
<!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Assign Subject to Faculty</h1>
            
          </div><!-- /.col -->
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Assign Subject To Faculty</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="d-flex justify-content-center">
            <center>
                <div id="hideDiv" class="">
                    @if(Session::get('update'))
                    <div class="alert alert-info">
                        {{ Session::get('update')}}
                    </div>
                    @endif
                    @if(Session::get('insert'))
                    <div class="alert alert-success">
                        {{ Session::get('insert')}}
                    </div>
                    @endif
                    @if(Session::get('delete'))
                    <div class="alert alert-danger">
                        {{ Session::get('delete')}}
                    </div>
                    @endif
                    </div>
            </center>
          </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                      <h3 class="card-title">Add batch semester</h3>
          
                      <div class="card-tools">
                        
                      </div>
                      
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::open(['url'=>'admin/add_subject_faculty','method'=>'POST','files' => true,'id'=>"quickForm","novalidate"=>"novalidate"]) !!}
                        
                        <div class="form-group">
                            {!!Form::label('Department','Department') !!}
                            {!! Form::select('department_id',array_merge(["" => 'Please Select',$department],), null,array_merge(['class'=>'form-control select2bs4','id'=>'department_id'])) !!}
                        </div> 
                        <div class="form-group">
                          {!!Form::label('Batch','Batch') !!}
                          {!! Form::select('batch_id',array_merge(["" => 'Please Select']), null,array_merge(['class'=>'form-control select2bs4','id'=>'batch_id'])) !!}
                      </div> 
                      <div class="form-group">
                        {!!Form::label('Semester','Semester') !!}
                        {!! Form::select('semester_id',array_merge(["" => 'Please Select']), null,array_merge(['class'=>'form-control select2bs4','id'=>'semester_id'])) !!}
                    </div>     
                          <div class="form-group">
                            {!!Form::label('Faculty','Faculty') !!}
                            {!! Form::select('faculty_id',array_merge(["" => 'Please Select',$faculty]), null,array_merge(['class'=>'form-control select2bs4','id'=>'faculty_id'])) !!}
                            
                            
                          </div>
                          <div class="form-group">
                            {!!Form::label('Subject','Subject') !!}
                            {!! Form::select('subject_id',array_merge(["" => 'Please Select']), null,array_merge(['class'=>'form-control select2bs4','id'=>'subject_id'])) !!}
                            
                            
                          </div>     
                            
                    </div>
                        <!-- /.col -->
                      <!-- /.row -->
                    <!-- /.card-body -->
                    <div class="card-footer">
                        {!!Form::submit('Submit',['class'=>'btn btn-info']);!!}
                        {!! Form::close() !!}
                    </div>
                  </div>
                  <!-- /.card -->
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">View Faculty Subject</h3>  
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>No</th>
                          <th>Batch</th>
                          <th>Department</th>
                          <th>Semester</th>
                          <th>Subject</th>
                          <th>Faculty</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          @php
                              $i=1;
                          @endphp
                          @foreach ($faculty_subject as $fac_sub)
                              <tr>
                                  <td>{{$i++}}</td>
                                  <td>{{DB::table('batches')->where('id', $fac_sub->batch_id)->value('batch_name')}}</td>
                                  <td>{{DB::table('departments')->where('id', $fac_sub->department_id)->value('department_name')}}</td>
                                  <td>{{DB::table('semesters')->where('id', $fac_sub->semester_id)->value('semester')}}</td>
                                  <td>{{DB::table('subjects')->where('id', $fac_sub->subject_id)->value('subject_name')}}</td>
                                  <td>{{DB::table('faculties')->where('id', $fac_sub->faculty_id)->value('full_name')}}</td>
                                  <td><button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModel{{$fac_sub->id}}">
                                    <i class="fas fa-trash"></i> Deletes
                                    </button></td>

                              </tr>
                                 <!--Delete Model Start-->
                          <!-- Modal -->
                            <div class="modal fade" id="deleteModel{{$fac_sub->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                                  </div>
                                  <div class="modal-body">
                                      {!! Form::model($fac_sub, ['method'=>'DELETE','files' => true,'route' => ['add_subject_faculty.destroy', $fac_sub->id]]) !!}
                                          Are You Sure You Want to Delete
                                  </div>
                                  <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                  {!!Form::submit('Yes',['class'=>'btn btn-info']);!!}
                      {!! Form::close() !!}
                                  </div>
                              </div>
                              </div>
                          </div>

                        <!--Delete Model End-->
                          @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                              <tr>
                                <th>No</th>
                                <th>Batch</th>
                                <th>Department</th>
                                <th>Semester</th>
                                <th>Subject</th>
                                <th>Faculty</th>
                                <th>Action</th>
                              </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.card-body -->
                  </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <script type="text/javascript">
        $(document).ready(function () {
          $("#department_id").on('change', function () {
            var departmentId=$('#department_id').val();
            $('#batch_id').html('');
            $('#semester_id').html();
                $.ajax({
                    url: '{{ route('getBatch') }}?department='+departmentId,
                    type: 'get',
                    success: function (res) {
                        $('#batch_id').html('<option value="">Select Batch</option>');
                        $.each(res, function (key, value) {
                            $('#batch_id').append('<option value="' + value
                                .id + '">' + value.batch_name+'--'+value.batch_year + '</option>');
                        });
                    }
                });
          });
          $("#batch_id").on('change', function () {
            var batchId=$('#batch_id').val();
            var departmentId=$('#department_id').val();
            $('#semester_id').html('');
            if(batchId != '' && departmentId !='')
            {

                $.ajax({
                    url: '{{ route('getBatchSubject') }}?department_id='+departmentId+'&batch_id='+batchId,
                    type: 'get',
                    success: function (res) {
                        $('#semester_id').html('<option value=""> Select Semester</option>');
                        $.each(res, function (key, value) {
                            $('#semester_id').append('<option value="' + value
                                .semester_id + '">' + value.semester_id + '</option>');
                        });
                    }
                });
            }
          });
          $("#faculty_id").on('change', function () {
            var batchId=$('#batch_id').val();
            var departmentId=$('#department_id').val();
            var facultyId=$('#faculty_id').val();
            var semesterId=$('#semester_id').val();
            if(batchId != '' && departmentId !='' && facultyId!='')
            {
                $.ajax({
                    url: '{{ route('getBatchDepartmentSubject') }}?department_id='+departmentId+'&batch_id='+batchId+'&faculty_id='+facultyId+'&semester_id='+semesterId,
                    type: 'get',
                    success: function (res) {
                        console.log(res);
                        $('#subject_id').html('<option value=""> Select Subject</option>');
                        $.each(res, function (key, value) {
                            $('#subject_id').append('<option value="' + value
                                .id + '">' +value.subject_code+'--'+value.subject_name + '</option>');
                        });
                    }
                });
            }
          });
        });
    </script>    
<!-- jquery-validation -->
<script src="{{asset('admin_public/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('admin_public/plugins/jquery-validation/additional-methods.min.js')}}"></script>

<script>
  $(function () {
    $.validator.setDefaults({
     
    });
    $('#quickForm').validate({
      rules: {       
        email: {
        required: true,
        email: true,
        },
        department_id: {
          required:true,
        },
        batch_id:{
          required:true,
        },
        semester_id:{
          required:true,
        },
        faculty_id:{
          required:true,
        },
        subject_id:{
          required:true,
        },
      },
      messages: {
        department_id: {
          required: "Please Select Department",
        },
        subject_id:{
          required:"Please Select Subject",
        },
        semester_id:{
          required:"Please Select Semester",
        },
        faculty_id:{
          required:'Please Select Faculty',
        },
        email: {
          required: "Please enter a email address",
          email: "Please enter a vaild email address"
        },
        batch_id:{
          required:"Please Select Batch"
        },
        semester_id:{
          required:"Please Select Semester"
        }
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
  </script>
    <!-- /.content -->
    @endsection