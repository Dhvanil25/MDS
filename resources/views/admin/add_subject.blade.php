@extends('admin.layout')
@section('content')
<!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Subject</h1>
            
          </div><!-- /.col -->
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Subject</li>
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
                      <h3 class="card-title">Add Subject</h3>
          
                      <div class="card-tools">
                        
                      </div>
                      
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::open(['url'=>'admin/add_subject','method'=>'POST','files' => true,'id'=>"quickForm","novalidate"=>"novalidate"]) !!}
                        <div class="row">
                            <div class="form-group col-lg-4">
                                {!!Form::label('Department','Department') !!}
                                {!! Form::select('department_id',array_merge(["" => 'Please Select',$department],), null,array_merge(['class'=>'form-control','id'=>'department'])) !!}
                            </div>    
                            <div class="form-group col-lg-4">
                                {!!Form::label('Semester','Semester') !!}
                                {!! Form::select('semester_id',array_merge(["" => 'Please Select',$semester],), null,array_merge(['class'=>'form-control','id'=>'semester'])) !!}
                            </div>
                            <div class="form-group col-lg-4">
                                {!! Form::label('Subject Name', 'Subject Name') !!}
                                {!!Form::text('subject_name',null,array_merge(['class' => 'form-control'],['placeholder'=>'Enter Subject Name'],['required'=>true]))!!}
                            </div>
                            <div class="form-group col-lg-2">
                                {!! Form::label('Subject Code', 'Subject Code') !!}
                                {!!Form::text('subject_code',null,array_merge(['class' => 'form-control'],['placeholder'=>'Enter Subject Code'],['required'=>true],['id'=>'subject_code']))!!}
                            </div>
                            <div class="form-group col-lg-2">
                                    {!! Form::label('practical', 'Practical') !!}
                                    <br>
                                    <div class="form-control">
                                        YES {{ Form::radio('subject_pratical', '1' , true,array_merge(['id'=>'subject_pratical'])) }}
                                        NO {{ Form::radio('subject_pratical', '0' , false,array_merge(['id'=>'subject_pratical'])) }}
                                    </div>
                            </div>
                            <div class="form-group col-lg-2">
                                {!! Form::label('Theory', 'Theory') !!}
                                <br>
                                <div class="form-control">
                                    YES {{ Form::radio('subject_theory', '1' , true) }}
                                    NO {{ Form::radio('subject_theory', '0' , false) }}
                                </div>
                            </div>
                            <div class="form-group col-lg-2">
                              {!! Form::label('Code Mirror name', 'Code Mirror name') !!}
                              {!!Form::text('codemirror_name',null,array_merge(['class' => 'form-control'],['placeholder'=>''],['id'=>'codemirror_name'],['required'=>true]))!!}
                             </div>
                             <div class="form-group col-lg-2">
                              {!! Form::label('Api Language', 'Api Language') !!}
                              {!!Form::text('api_language',null,array_merge(['class' => 'form-control'],['placeholder'=>''],['id'=>'api_language'],['required'=>true]))!!}
                             </div>
                            <div class="form-group col-lg-4">
                                {!! Form::label('Syllabus', 'Syllabus') !!}<br>
                                <div class="form-control">
                                {!! Form::File('subject_syllabus', null,array_merge(['class'=>'form-control'])) !!}
                                </div>
                            </div>
                        <!-- /.col -->
                        </div>
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
                      <h3 class="card-title">View Subject</h3>  
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>No</th>
                          <th>Department</th>
                          <th>Semester</th>
                          <th>Subject</th>
                          <th>Subject Code</th>
                          <th>View Syllabus</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                        @endphp
                        
                        @foreach($subject as $sub)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{DB::table('departments')->where('id', $sub->department_id)->value('department_name')}}</td>
                                <td>{{$sub->semester_id}}</td>
                                <td>{{$sub->subject_name}}</td>
                                <td>{{$sub->subject_code}}</td>
                                <td> <a href="{{asset('syllabus')}}/{{$sub->subject_syllabus}}" target="_blank" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a> </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModel{{$sub->id}}">
                                        <i class="fas fa-trash"></i> Deletes
                                    </button>
                                    <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#editModel{{$sub->id}}">
                                            <i class="fas fa-edit"></i> Edit
                                    </button>
                                </td>
                            </tr>
                            <!--Delete Model Start-->
                  <!-- Modal -->
                    <div class="modal fade" id="deleteModel{{$sub->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                {!! Form::model($sub, ['method'=>'DELETE','files' => true,'route' => ['add_subject.destroy', $sub->id]]) !!}
                                    Are You Sure You Want to Delete <b>{{$sub->subject_name}}</b> 
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
                  <!--Edit Model Start-->
                  <div class="modal fade" id="editModel{{$sub->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <div id="email_check" style="color:red"></div>
                          {!! Form::model($sub, ['method'=>'PATCH','files' => true,'route' => ['add_subject.update', $sub->id]]) !!}
                          
                         <div class="form-group">
                                {!!Form::label('Department','Department') !!}
                                {!! Form::select('department_id',array_merge(["" => 'Please Select',$department],), null,array_merge(['class'=>'form-control','id'=>'department'])) !!}
                            </div>    
                            <div class="form-group">
                                {!!Form::label('Semester','Semester') !!}
                                {!! Form::select('semester_id',array_merge(["" => 'Please Select',$semester],), null,array_merge(['class'=>'form-control','id'=>'semester'])) !!}
                            </div>
                            <div class="form-group ">
                                {!! Form::label('Subject Name', 'Subject Name') !!}
                                {!!Form::text('subject_name',null,array_merge(['class' => 'form-control'],['placeholder'=>'Enter Subject Name'],['required'=>true]))!!}
                            </div>
                            <div class="form-group ">
                                {!! Form::label('Subject Code', 'Subject Code') !!}
                                {!!Form::text('subject_code',null,array_merge(['class' => 'form-control'],['placeholder'=>'Enter Subject Name'],['required'=>true],['id'=>'subject_code']))!!}
                                
                            </div>
                            <div class="form-group">
                                    {!! Form::label('practical', 'Practical') !!}
                                    <br>
                                    <div class="form-control">
                                        YES {{ Form::radio('subject_pratical', '1' , true,array_merge(['id'=>"subject_pratical$i"])) }}
                                        NO {{ Form::radio('subject_pratical', '0' , false,array_merge(['id'=>"subject_pratical$i"]))}}
                                    </div>
                            </div>
                            <div class="form-group">
                              {!! Form::label('Code Mirror name', 'Code Mirror name') !!}
                              {!!Form::text('codemirror_name',null,array_merge(['class' => 'form-control'],['placeholder'=>''],['id'=>"codemirror_name$i"],['required'=>true]))!!}
                             </div>
                             <div class="form-group">
                              {!! Form::label('Api Language', 'Api Language') !!}
                              {!!Form::text('api_language',null,array_merge(['class' => 'form-control'],['placeholder'=>''],['id'=>"api_language$i"],['required'=>true]))!!}
                             </div>
                            <div class="form-group">
                                {!! Form::label('Theory', 'Theory') !!}
                                <br>
                                <div class="form-control">
                                    YES {{ Form::radio('subject_theory', '1' , true) }}
                                    NO {{ Form::radio('subject_theory', '0' , false) }}
                                </div>
                            </div>
                            <div class="form-group ">
                                {!! Form::label('Syllabus', 'Syllabus') !!}<br>
                                <div class="form-control">
                                {!! Form::File('subject_syllabus', null,array_merge(['class'=>'form-control'])) !!}
                                </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        {!!Form::submit('Yes',['class'=>'btn btn-info']);!!}
                        {!! Form::close() !!}
                        </div>
                    </div>
                    </div>
                </div>
                <script>
                $(document).ready(function () {
                  $("input[type=radio][id=subject_pratical{{$i}}]").on('change', function() {
                  switch ($(this).val()) {
                    case '1':
                      $('#codemirror_name{{$i}}').prop('readonly', false);
                      $('#api_language{{$i}}').prop('readonly', false);
                      break;
                    case '0':
                      $('#codemirror_name{{$i}}').prop('readonly', true);
                      $('#api_language{{$i}}').prop('readonly', true);
                      $('#codemirror_name{{$i}}').prop('value', '');
                      $('#api_language{{$i}}').prop('value', '');
                      $("#codemirror_name{{$i}}").prop('required', false);
                  $("#api_language{{$i}}").prop('required', false);
                      break;
                  }
                });
                })
                  </script>
                  <!--Edit Model End-->
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>No</th>
                          <th>Department</th>
                          <th>Semester</th>
                          <th>Subject</th>
                          <th>Subject Code</th>
                          <th>View Syllabus</th>
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
          $('input[type=radio][id=subject_pratical]').on('change', function() {
              switch ($(this).val()) {
                case '1':
                  $('#codemirror_name').prop('readonly', false);
                  $('#api_language').prop('readonly', false);
                  $('#codemirror_name').prop('required', true);
                  $('#api_language').prop('required', true);
                  break;
                case '0':
                  $('#codemirror_name').prop('readonly', true);
                  $('#api_language').prop('readonly', true);
                  $('#codemirror_name').prop('value', '');
                  $('#api_language').prop('value', '');
                  $('#codemirror_name').prop('required', false);
                  $('#api_language').prop('required', false);
                  break;
              }
            });
            $('#subject_code').on('keyup', function () {
                var subject_code = this.value;
                $.ajax({
                    url: '{{ route('checkSubjectCode') }}?subject_code='+subject_code,
                    type: 'get',
                    success: function (res) {
                        
                        if(res==1)
                        {
                            alert("This Code Exsist");
                            $('#subject_code').val('')
                        }
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
        
        department_id: {
          required:true,
        },
        subject_name:{
            required:true,
        },
        subject_code:{
            required:true
        },
        semester_id:{
          required:true,
        },
        subject_syllabus:{
            required:true,
            extension:'pdf'
        }
      },
      messages: {
        department_id: {
          required: "Please Select Department",
        },
        subject_syllabus:{
            required:"Please Upload Syllabus",
            extension:"select only pdf",
        },
        subject_name:{
            required:'Please Enter Subject Name,',
        },
        semester_id:{
          required:"Please Select Semester"
        },
        subject_code:{
            required:"Please Enter Subject Code"
        },
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