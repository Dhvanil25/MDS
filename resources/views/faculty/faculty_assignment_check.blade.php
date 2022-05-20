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
              <h3 class="card-title">Details</h3>
  
              <div class="card-tools">
              </div>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <b>Semester:</b>{{DB::table('semesters')->where('id', $assignment->semester_id)->value('semester')}}<br>
                        <b>Subject Name:</b>{{DB::table('subjects')->where('id', $assignment->subject_id)->value('subject_name')}}<br>
                        <b>Subject Code:</b>{{DB::table('subjects')->where('id', $assignment->subject_id)->value('subject_code')}}<br>
                        <b>Batch:</b>{{DB::table('batches')->where('id', $assignment->batch_id)->value('batch_name')}}<br>
                    </div>
                    <div class="col-lg-6">
                        <b>Assignment Title:</b>{{$assignment->assignment_title}}
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
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        
                    </div>
                  </div>
                  <!-- /.card -->
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">View Assignment</h3>  
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>No</th>
                          <th>Enrollments</th>
                          <th>Name</th>
                          <th>Submit Date</th>
                          <th>PDF</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                        @endphp
                        @foreach ($student_assignment as $sa)
                        @php
                        $student_detail=DB::table('students')->where('id', $sa->student_id)->get()
                        @endphp
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$student_detail[0]->enrollment_number}}</td>
                            <td>{{$student_detail[0]->full_name}}</td>
                            <td>{{date('d-M-Y', strtotime($sa->supload_date));}}</td>  
                            <td><a href="{{asset('upload_assignment')}}/{{$sa->pdf}}" target="_blank" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a> </td>
                            <td>
                                    @if($sa->status=="0")
                                    <span class="badge bg-warning"><i class="fa">&#xf071;</i> Under Review</span>
                                    @elseif($sa->status=="1")
                                    <span class="badge bg-success"><i class="fa">&#xf00c;</i>
                                      Approve</span>
                                    @elseif($sa->status=="2")
                                    <span class="badge bg-danger"><i class="fa">&#xf00d;</i>
                                      Cancel</span>
                                    @endif
                            </td>
                            <td>
                              <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#editModel{{$sa->id}}">
                                <i class="fas fa-edit"></i> Response
                              </button>

                            </td>
                                              <div class="modal fade" id="editModel{{$sa->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                          {!! Form::model($sa, ['method'=>'PATCH','files' => true,'route' => ['response.update', $sa->id]]) !!}
                          <div class="form-control">
                           {{ Form::radio('status', '1' , true) }}<span class="badge bg-success"><i class="fa">&#xf00c;</i>
                            Approve</span>
                          {{ Form::radio('status', '2', false,)}}<span class="badge bg-danger"><i class="fa">&#xf00d;</i>
                            Cancel</span>
                          </div>
                          <div class="form-group">
                            <label>Note</label>
                            {!!Form::textarea('note',null,array_merge(['class' => 'form-control'],['placeholder'=>'']))!!}
                            {!!Form::hidden('assignment_id',null,array_merge(['class' => 'form-control'],['placeholder'=>'']))!!}

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

                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Enrollments</th>
                                <th>Name</th>
                                <th>Submit Date</th>
                                <th>PDF</th>
                                <th>Status</th>
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

    <!-- /.content -->
    @endsection