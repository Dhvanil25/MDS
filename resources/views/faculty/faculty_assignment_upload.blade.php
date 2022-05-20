@extends('faculty.layout')
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
          <!--Subject Detail -->
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Detailss</h3>
  
              <div class="card-tools">
              </div>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <b>Semester:</b>{{DB::table('semesters')->where('id', $faculty_subject_detail_fetch[0]->semester_id)->value('semester')}}<br>
                        <b>Subject Name:</b>{{DB::table('subjects')->where('id', $faculty_subject_detail_fetch[0]->subject_id)->value('subject_name')}}<br>
                        <b>Subject Code:</b>{{DB::table('subjects')->where('id', $faculty_subject_detail_fetch[0]->subject_id)->value('subject_code')}}<br>
                    </div>
                    <div class="col-lg-6">
                        <b>Department:</b>{{DB::table('departments')->where('id', $faculty_subject_detail_fetch[0]->department_id)->value('department_name')}}<br>
                        <b>Batch:</b>{{DB::table('batches')->where('id', $faculty_subject_detail_fetch[0]->batch_id)->value('batch_name')}}<br>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
           
          </div>
          <!--End Subject Detail-->
        <!-- Small boxes (Stat box) -->
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                      <h3 class="card-title">Add Material</h3>
          
                      <div class="card-tools">

                      </div>
                      
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    @if (isset($assignment_edit))
                    {!! Form::model($assignment_edit, ['method'=>'PATCH','files' => true,'route' => ['assignment.update', $assignment_edit->id]]) !!} 
                        
                    {!!Form::hidden('faculty_subject_id',$faculty_subject_detail_fetch[0]->id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('faculty_id',$faculty_subject_detail_fetch[0]->faculty_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('batch_id',$faculty_subject_detail_fetch[0]->batch_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('subject_id',$faculty_subject_detail_fetch[0]->subject_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('semester_id',$faculty_subject_detail_fetch[0]->semester_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('department_id',$faculty_subject_detail_fetch[0]->department_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    <div class="form-group">
                        {!! Form::label('Title', 'Title') !!}
                        {!!Form::text('assignment_title',null,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                       
                    </div>                    
                    <div class="form-group">
                        {!! Form::label('PDF', 'PDF') !!}<br>
                        <div class="form-control">
                        {!! Form::File('assignment_question', null,array_merge(['class'=>'form-control'])) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Upload Date</label>
                            {!!Form::date('upload_date',\Carbon\Carbon::now(),array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Submit Date</label>
                            {!!Form::date('submit_date',null,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                        </div>
                    </div>
                    @else
                    {!! Form::open(['url'=>'faculty/assignment','method'=>'POST','files' => true,'id'=>"quickForm","novalidate"=>"novalidate"]) !!}
                        
                    {!!Form::hidden('faculty_subject_id',$faculty_subject_detail_fetch[0]->id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('faculty_id',$faculty_subject_detail_fetch[0]->faculty_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('batch_id',$faculty_subject_detail_fetch[0]->batch_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('subject_id',$faculty_subject_detail_fetch[0]->subject_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('semester_id',$faculty_subject_detail_fetch[0]->semester_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('department_id',$faculty_subject_detail_fetch[0]->department_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    <div class="form-group">
                        {!! Form::label('Title', 'Title') !!}
                        {!!Form::text('assignment_title',null,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                       
                    </div>
                    <div class="form-group">
                        {!! Form::label('PDF', 'PDF') !!}<br>
                        <div class="form-control">
                        {!! Form::File('assignment_question', null,array_merge(['class'=>'form-control'])) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label>Upload Date</label>
                            {!!Form::date('upload_date',\Carbon\Carbon::now(),array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Submit Date</label>
                            {!!Form::date('submit_date',null,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                        </div>
                    </div>
                    @endif
                        
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
                          <th>Batch</th>
                          <th>Subject</th>
                          <th>Semester</th>
                          <th>Title</th>
                          <th>View pdf</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          @php
                              $i=0;
                          @endphp
                          @foreach ($faculty_assignment as $fa)
                             <tr>
                               <td>{{++$i}}</td>
                              <td>{{DB::table('batches')->where('id', $fa->batch_id)->value('batch_name')}}</td>
                              <td>{{DB::table('subjects')->where('id', $fa->subject_id)->value('subject_name')}}--{{DB::table('subjects')->where('id', $fa->subject_id)->value('subject_code')}}</td>
                              <td>{{DB::table('semesters')->where('id', $fa->semester_id)->value('semester')}}</td>
                              <td>{{$fa->assignment_title}}</td>
                              <td>@if ($fa->assignment_question!='')
                                <a href="{{asset('assignment_question')}}/{{$fa->assignment_question}}" target="_blank" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a> 
                                <a href="{{asset('assignment_question')}}/{{$fa->assignment_question}}" download class="btn btn-info btn-xs"><i class="fas fa-download"></i></a> 

                                @else
                                  <label class="badge badge-danger">PDF NOT UPLOADED</label>
                                @endif</td>
                              <td>
                                <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModel{{$fa->id}}">
                                  <i class="fas fa-trash"></i> Deletes
                                  </button>
                                  <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#editModel{{$fa->id}}">
                                    <i class="fas fa-edit"></i> Edit
                                  </button>
                                  <a type="button" class="btn btn-primary btn-xs" href="/faculty/faculty_assignment_check/{{$fa->id}}">
                                    Check
                                  </a>
                              </td>
                             </tr> 
                             <!--Delete Model Start-->
                            <!-- Modal -->
                              <div class="modal fade" id="deleteModel{{$fa->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        {!! Form::model($fa, ['method'=>'DELETE','files' => true,'route' => ['assignment.destroy', $fa->id]]) !!}
                                            Are You Sure You Want to Delete <b>{{$fa->assignment_title}}</b>
                                            {!!Form::text('id',$fa->id,array_merge(['class' => 'form-control'],['placeholder'=>'Eg abc@gmail.com'],['required'=>true]))!!}
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
                  <div class="modal fade" id="editModel{{$fa->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                          {!!  Form::model($fa, ['method'=>"GET",'route' => ['assignment.edit', $fa->id]])   !!}
                          Are You Sure You Want to EDIT <b>{{$fa->assignment_title}}</b>

                       </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        {!!Form::submit('Yes',['class'=>'btn btn-info']);!!}
                        {!! Form::close() !!}
                        </div>
                    </div>
                    </div>
                </div>

                 
                          @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>No</th>
                            <th>Batch</th>
                            <th>Subject</th>
                            <th>Semester</th>
                            <th>Title</th>
                            <th>View pdf</th>
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

<script>
  $(function () {
    $.validator.setDefaults({
     
    });
    $('#quickForm').validate({
      rules: {       
        
        assignment_title: {
          required:true,
        },
        assignment_question:{
            extension: "pdf"
        }
      },
      messages: {
        assignment_title: {
          required: "Please Enter Material Title",
        },
        assignment_question:{
            extension: "Upload only PDF Files"
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
  <!-- Summernote -->

    <!-- /.content -->
    @endsection