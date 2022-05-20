@extends('admin.layout')
@section('content')
<!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Batch Semester</h1>
            
          </div><!-- /.col -->
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Batch Semester</li>
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
                        {!! Form::open(['url'=>'admin/add_batch_semester','method'=>'POST','files' => true,'id'=>"quickForm","novalidate"=>"novalidate"]) !!}
                        
                        <div class="form-group">
                            {!!Form::label('Department','Department') !!}
                            {!! Form::select('department_id',array_merge(["" => 'Please Select',$department],), null,array_merge(['class'=>'form-control','id'=>'department'])) !!}
                        </div>    
                        <div class="form-group">
                          <div class="form-group">
                            {!!Form::label('Batch','Batch') !!}
                            {!! Form::select('batch_id',array_merge(["" => 'Please Select']), null,array_merge(['class'=>'form-control','id'=>'batch'])) !!}
                            
                            
                          </div>   
                            </div>
                            <div class="form-group">
                              {!!Form::label('Semester','Semester') !!}
                              {!! Form::select('semester_id',array_merge(["" => 'Please Select']), null,array_merge(['class'=>'form-control','id'=>'semester'])) !!}      
                                
                            </div>
                        <!-- /.col -->
                      <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        {!!Form::submit('Submit',['class'=>'btn btn-info']);!!}
                        {!! Form::close() !!}
                    </div>
                  </div>
                  <!-- /.card -->
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">View Batch Semester</h3>  
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>No</th>
                          <th>Batch</th>
                          <th>Semester</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          @php
                          $i = 1;
                           @endphp
                          @foreach ($batchsemester as $bs)
                              <tr>
                                <td>{{$i++}}</td>
                                
                                <td>{{DB::table('batches')->where('id', $bs->batch_id)->value('batch_name')}}</td>
                                <td>{{DB::table('semesters')->where('id', $bs->semester_id)->value('semester')}}</td>
                                <td> <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModel{{$bs->id}}">
                                  <i class="fas fa-trash"></i> Deletes
                                  </button></td>

                              </tr>
                              <!--Delete Model Start-->
                          <!-- Modal -->
                            <div class="modal fade" id="deleteModel{{$bs->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                                  </div>
                                  <div class="modal-body">
                                      {!! Form::model($bs, ['method'=>'DELETE','files' => true,'route' => ['add_batch_semester.destroy', $bs->id]]) !!}
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
                              <th>No</th>
                              <th>Batch</th>
                              <th>Semester</th>
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
            $('#department').on('change', function () {
                var departmentId = this.value;
                $('#batch').html('');
                $.ajax({
                    url: '{{ route('getBatch') }}?department='+departmentId,
                    type: 'get',
                    success: function (res) {
                        $('#batch').html('<option value="">Select Batch</option>');
                        $.each(res, function (key, value) {
                            $('#batch').append('<option value="' + value
                                .id + '">' + value.batch_name+'--'+value.batch_year + '</option>');
                        });
                        $('#semester').html('<option value="">Select Semester</option>');
                    }
                });
            });
            $('#batch').on('change', function () {
                var batchId = this.value;
                $('#semester').html('');
                $.ajax({
                    url: '{{ route('getSemster') }}?batch_id='+batchId,
                    type: 'get',
                    success: function (res) {
                        $('#semester').html('<option value="">Select Semester</option>');
                        $.each(res, function (key, value) {
                            $('#semester').append('<option value="' + value
                                .id + '">' + value.semester + '</option>');
                        });
                    }
                });
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
        }
      },
      messages: {
        department_id: {
          required: "Please Select Department",
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