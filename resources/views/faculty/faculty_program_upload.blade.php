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
                        @php
                            $language=DB::table('subjects')->where('id', $faculty_subject_detail_fetch[0]->subject_id)->value('codemirror_name')
                        @endphp
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
                      <h3 class="card-title">Add Program</h3>
          
                      <div class="card-tools">

                      </div>
                      
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    @if (isset($program_edit))
                    {!! Form::model($program_edit, ['method'=>'PATCH','files' => true,'route' => ['program.update', $program_edit->id]]) !!} 
                        
                    {!!Form::hidden('faculty_subject_id',$faculty_subject_detail_fetch[0]->id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('faculty_id',$faculty_subject_detail_fetch[0]->faculty_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('batch_id',$faculty_subject_detail_fetch[0]->batch_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('subject_id',$faculty_subject_detail_fetch[0]->subject_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('semester_id',$faculty_subject_detail_fetch[0]->semester_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('department_id',$faculty_subject_detail_fetch[0]->department_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    <div class="form-group">
                        {!! Form::label('Program Title', 'Program Title') !!}
                        {!!Form::text('program_title',null,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                       
                    </div>
                    <div class="form-group">
                        {!! Form::label('Program Description', 'Program Description') !!}     
                        {!! Form::textarea('program_description',null,['id'=>'summernote', 'rows' => 2, 'cols' => 40]) !!}
                    </div>
                    <div class="form-group col-lg-12">
                        {!! Form::label('code', " Editor") !!}     
                        {!! Form::textarea('program',null) !!}
                        <div id="editor" style="height: 200px;"></div>
                      </div>
                    

                    @else
                    {!! Form::open(['url'=>'faculty/program','method'=>'POST','files' => true,'id'=>"quickForm","novalidate"=>"novalidate"]) !!}
                        
                    {!!Form::hidden('faculty_subject_id',$faculty_subject_detail_fetch[0]->id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('faculty_id',$faculty_subject_detail_fetch[0]->faculty_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('batch_id',$faculty_subject_detail_fetch[0]->batch_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('subject_id',$faculty_subject_detail_fetch[0]->subject_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('semester_id',$faculty_subject_detail_fetch[0]->semester_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                    {!!Form::hidden('department_id',$faculty_subject_detail_fetch[0]->department_id,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}

                    <div class="form-group">
                        {!! Form::label('Program Title', 'Program Title') !!}
                        {!!Form::text('program_title',null,array_merge(['class' => 'form-control'],['placeholder'=>'Enter title'],['required'=>true]))!!}
                       
                    </div>
                    <div class="form-group">
                        {!! Form::label('Program Description', 'Program Description') !!}     
                        {!! Form::textarea('program_description',null,['id'=>'summernote', 'rows' => 2, 'cols' => 40]) !!}
                    </div>
                    <div class="form-group col-lg-12">
                        {!! Form::label('code', " Editor") !!}     
                        {!! Form::textarea('program',null) !!}
                        <div id="editor" style="height: 200px;"></div>
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
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          @php
                              $i=0;
                          @endphp
                          @foreach ($faculty_program as $fp)
                          <tr>
                            <td>{{++$i}}</td>
                           <td>{{DB::table('batches')->where('id', $fp->batch_id)->value('batch_name')}}</td>
                           <td>{{DB::table('subjects')->where('id', $fp->subject_id)->value('subject_name')}}--{{DB::table('subjects')->where('id', $fp->subject_id)->value('subject_code')}}</td>
                           <td>{{DB::table('semesters')->where('id', $fp->semester_id)->value('semester')}}</td>
                           <td>{{$fp->program_title}}</td>
                           
                           <td>
                             <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModel{{$fp->id}}">
                               <i class="fas fa-trash"></i> Deletes
                               </button>
                               <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#editModel{{$fp->id}}">
                                 <i class="fas fa-edit"></i> Edit
                               </button>
                           </td>
                          </tr> 
                          <!--Delete Model Start-->
                         <!-- Modal -->
                           <div class="modal fade" id="deleteModel{{$fp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog" role="document">
                             <div class="modal-content">
                                 <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                                 </div>
                                 <div class="modal-body">
                                     {!! Form::model($fp, ['method'=>'DELETE','files' => true,'route' => ['program.destroy', $fp->id]]) !!}
                                         Are You Sure You Want to Delete <b>{{$fp->material_title}}</b>
                                         {!!Form::hidden('id',$fp->id,array_merge(['class' => 'form-control'],['placeholder'=>'Eg abc@gmail.com'],['required'=>true]))!!}
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
               <div class="modal fade" id="editModel{{$fp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                 <div class="modal-content">
                     <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                     </div>
                     <div class="modal-body">
                       {!!  Form::model($fp, ['method'=>"GET",'route' => ['program.edit', $fp->id]])   !!}
                       Are You Sure You Want to EDIT <b>{{$fp->program_title}}</b>

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
<!-- jquery-validation -->
<script src="{{asset('admin_public/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('admin_public/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('admin_public/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script src="{{asset('js/lib/ace.js')}}"></script>
<script src="{{asset('js/lib/theme-monokai.js')}}"></script>
<script>
  $(function () {
    $.validator.setDefaults({
     
    });
    $('#quickForm').validate({
      rules: {       
        
        material_title: {
          required:true,
        },
        material_pdf:{
            extension: "pdf"
        }
      },
      messages: {
        material_title: {
          required: "Please Enter Material Title",
        },
        material_pdf:{
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
<script>
    $(function () {
      // Summernote
      $('#summernote').summernote({
        toolbar: [
  ['pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
  
  ['style', ['style']],
  ['font', ['bold', 'underline', 'clear']],
  ['fontname', ['fontname']],
  ['fontsize', ['fontsize']],

  ['color', ['color']],
  ['para', ['ul', 'ol', 'paragraph']],
  ['table', ['table']],
  ['insert', ['link', 'picture',]],
  ['view', ['fullscreen', 'codeview', 'help']],
],
});
      
      // CodeMirror
      // CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      //   mode: "htmlmixed",
      //   theme: "monokai"
      // });
    })
  </script>

          <script>
            var editor = ace.edit("editor");
          
          window.onload = function() {
              editor.setTheme("ace/theme/monokai");
              editor.session.setMode("ace/mode/<?php echo $language?>");
              var textarea = $('textarea[name="program"]').hide();
              editor.getSession().setValue(textarea.val());
              //
          }
          editor.getSession().on('change', function(){
            var textarea = $('textarea[name="program"]')
            textarea.val(editor.getSession().getValue());
          });
          
          
          
                  </script>
          
    <!-- /.content -->
    @endsection