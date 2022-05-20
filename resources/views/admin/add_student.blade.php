@extends('admin.layout')
@section('content')
<!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Student</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Student</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
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
                      <h3 class="card-title">Add Student</h3>
          
                      <div class="card-tools">
                        
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      {!! Form::open(['url'=>'admin/add_student','method'=>'POST','files' => true,'id'=>"quickForm","novalidate"=>"novalidate"]) !!}
                            
                          <div class="row">
                            <div class="form-group col-lg-4">
                              {!! Form::label('Enrollment Number', 'Enrollment Number') !!}
                              {!!Form::text('enrollment_number',null,array_merge(['class' => 'form-control'],['placeholder'=>'Eg 200*****57'],['required'=>true]))!!}
                             
                          </div>
                          <div class="form-group col-lg-4">
                            {!! Form::label('Full Name', 'Full Name') !!}
                            {!!Form::text('full_name',null,array_merge(['class' => 'form-control'],['required'=>true]))!!}
                          </div>
                          <div class=" form-group col-lg-4">
                            {!! Form::label('Email Number', 'Email') !!}
                            {!!Form::text('email',null,array_merge(['class' => 'form-control'],['placeholder'=>'Eg abc@gmail.com'],['required'=>true]))!!}
                          </div>
                          
                        </div>
                        <div class="row">
                          <div class="form-group  col-lg-4">
                            {!! Form::label('Password', 'Password') !!}
                            {!!Form::text('password',null,array_merge(['class' => 'form-control'],['required'=>true]))!!}
                        </div>
                         
                          <div class="form-group  col-lg-4">
                            {!! Form::label('Mobile Number', 'Mobile Number') !!}
                            {!!Form::text('mobile_number',null,array_merge(['class' => 'form-control'],['placeholder'=>'Eg 999999999'],['required'=>true]))!!}
                          </div>
                          <div class="form-group  col-lg-4">
                            {!!Form::label('Batch','Batch') !!}
                            {!! Form::select('batch_id',array_merge(["" => 'Please Select',$batch],), null,array_merge(['class'=>'form-control'])) !!}
                          </div>
                          
                        </div>
                        <br>
                       <div class="row">
                        <div class="col-lg-4">
                          {!!Form::label('Profile','Profile Photo') !!}
                          {!! Form::File('profile', null,array_merge(['class'=>'form-control'])) !!}
                        </div>
                          </div>
                          <br>
                          
            
                        <!-- /.col -->
                      <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <input type="submit" name="btnsubmit" class="btn btn-info">
                                      </form>
                    </div>
                  </div>
                  <!-- /.card -->
           <!-- /.card -->
           <div class="card">
            <div class="card-header">
              <h3 class="card-title">View Department</h3>  
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Enrollment Number</th>
                  <th>Student Name</th>
                  <th>Batch</th>
                  <th>Photo</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                @endphp
                
                @foreach($student as $stud)
                <tr>
                  <td>{{ $i++}}</td>
                  <td>{{$stud->enrollment_number}}</td>
                  <td>{{$stud->full_name}}</td>
                  <td>{{$stud->batch_id}}</td>
                  <td><img height="50" width="50" src="{{asset('student_photos')}}/{{$stud->profile}}"></td>
                  <td>
                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModel{{$stud->id}}">
                      <i class="fas fa-trash"></i> Deletes
                      </button>
                      <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#editModel{{$stud->id}}">
                        <i class="fas fa-edit"></i> Edit
                      </button>
                  </td>
                  
                </tr>
                <!--Delete Model Start-->
                  <!-- Modal -->
                    <div class="modal fade" id="deleteModel{{$stud->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                {!! Form::model($stud, ['method'=>'DELETE','files' => true,'route' => ['add_student.destroy', $stud->id]]) !!}
                                    Are You Sure You Want to Delete <b>{{$stud->full_name}}</b> Student
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
                  <div class="modal fade" id="editModel{{$stud->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                          {!! Form::model($stud, ['method'=>'PATCH','files' => true,'route' => ['add_student.update', $stud->id]]) !!}
                          <div class="form-group">
                            {!! Form::label('Enrollment Number', 'Enrollment Number') !!}
                            {!!Form::text('enrollment_number',null,array_merge(['class' => 'form-control'],['placeholder'=>'Eg 200*****57'],['required'=>true]))!!} 
                          </div>
                          <div class="form-group">
                            {!! Form::label('Full Name', 'Full Name') !!}
                            {!!Form::text('full_name',null,array_merge(['class' => 'form-control'],['required'=>true]))!!}
                          </div>
                          <div class=" form-group">
                            {!! Form::label('Email Number', 'Email') !!}
                            {!!Form::text('email',null,array_merge(['class' => 'form-control'],['placeholder'=>'Eg abc@gmail.com'],['required'=>true]))!!}
                          </div>
                          <div class="form-group">
                            {!! Form::label('Password', 'Password') !!}
                            {!!Form::text('password',null,array_merge(['class' => 'form-control'],['required'=>true]))!!}
                        </div>
                         
                          <div class="form-group">
                            {!! Form::label('Mobile Number', 'Mobile Number') !!}
                            {!!Form::text('mobile_number',null,array_merge(['class' => 'form-control'],['placeholder'=>'Eg 999999999'],['required'=>true]))!!}
                          </div>
                          <div class="form-group">
                            {!!Form::label('Batch','Batch') !!}
                            {!! Form::select('batch_id',array_merge(["" => 'Please Select',$batch],), null,array_merge(['class'=>'form-control'])) !!}
                          </div>
                          <div class="form-group">
                            {!!Form::label('Profile','Profile Photo') !!}
                            {!! Form::File('profile', null,array_merge(['class'=>'form-control'])) !!}
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

                  <!--Edit Model End-->
                @endforeach
              </tbody>
                <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Enrollment Number</th>
                      <th>Student Name</th>
                      <th>Batch</th>
                      <th>Photo</th>
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
    <!-- /.content -->
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
            enrollment_number: {
              required:true,
            },
            batch_id:{
              required:true,
            },
            mobile_number:{
              required:true,
            },
            password:{
              required:true
            }
          },
          messages: {
            enrollment_number: {
              required: "Please Enter Enrollment Number",
            },
            email: {
              required: "Please enter a email address",
              email: "Please enter a vaild email address"
            },
            batch_id:{
              required:"Please Select Batch"
            },
            mobile_number:{
              required:"Please Enter Mobile Number"
            },
            password:{
              required:"Please Enter Password"
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
    @endsection