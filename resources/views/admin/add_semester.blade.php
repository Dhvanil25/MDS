@extends('admin.layout')
@section('content')
<!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Semester</h1>
            
          </div><!-- /.col -->
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Semester</li>
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
                      <h3 class="card-title">Add Semester</h3>
          
                      <div class="card-tools">
                        
                      </div>
                      
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        {!! Form::open(['url'=>'admin/add_semester','method'=>'POST','files' => true,'class'=>"swalDefaultSuccess",'id'=>"quickForm","novalidate"=>"novalidate"]) !!}
                            <div class="form-group">
                                
                                {!! Form::label('Semester', 'Semester') !!}
                                {!!Form::text('semester',null,array_merge(['class' => 'form-control'],['placeholder'=>'Enter Semester'],['required'=>true]))!!}
                                @error('fullname')
                                    <div class="text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!!Form::label('Semester Image','Semester Image') !!}
                                {!! Form::File('semester_image', null,array_merge(['class'=>'form-control'])) !!}
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
                      <h3 class="card-title">View Department</h3>  
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>No</th>
                          <th>Semester</th>
                          <th>Semester Image</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                        @endphp
                        
                        @foreach($semester as $sem)
                        <tr>
                          <td>{{ $i++}}</td>
                          <td>{{$sem->semester}}</td>
                          <td><img height="50" width="50" src="{{asset('semester_photo')}}/{{$sem->semester_image}}"></td>
                          <td>
                            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#deleteModel{{$sem->id}}">
                              <i class="fas fa-trash"></i> Deletes
                              </button>
                              <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#editModel{{$sem->id}}">
                                <i class="fas fa-edit"></i> Edit
                              </button>
                          </td>
                          
                        </tr>
                        <!--Delete Model Start-->
                          <!-- Modal -->
                            <div class="modal fade" id="deleteModel{{$sem->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        {!! Form::model($sem, ['method'=>'DELETE','files' => true,'route' => ['add_semester.destroy', $sem->id]]) !!}
                                            Are You Sure You Want to Delete <b>{{$sem->semester}}</b>
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
                          <div class="modal fade" id="editModel{{$sem->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                  {!! Form::model($sem, ['method'=>'PATCH','files' => true,'route' => ['add_semester.update', $sem->id]]) !!}
                                  <div class="form-group">
                                    {!! Form::label('Semester Name', 'Semester Name') !!}
                                    {!!Form::text('semester',null,array_merge(['class' => 'form-control'],['placeholder'=>'Enter Semester Name'],['required'=>true]))!!}
                                    @error('fullname')
                                        <div class="text text-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div class="form-group">
                                        {!!Form::label('Semester Image','Semester Image') !!}
                                        {!! Form::File('semester_image', null,array_merge(['class'=>'form-control'])) !!}
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
                                <th>Semester</th>
                                <th>Semester Image</th>
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
            semster: {
              required:true,
            },
          },
          messages: {
            semster: {
              required: "Please Enter Semester Name",
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
    @endsection
    