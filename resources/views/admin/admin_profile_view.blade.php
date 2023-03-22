@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card" >
                    <br> <br>
                    <center><img src="{{(!empty($admindata->profile_image))? url('upload/admin_images/'.$admindata->profile_image):url('upload/no_image.jpg')}}" style="height:250px ; width:250px" class="card-img-top rounded-circle" alt="..."></center>
                    <hr>
                    <div class="card-body">
                      <h4 class="card-text">Name: {{$admindata->name}}</h4><hr>
                      <h4 class="card-text">UserName: {{$admindata->username}}</h4><hr>
                      <h4 class="card-text">Email: {{$admindata->email}}</h4><hr>
                      <a href="{{route('edit.profile')}}" type="" class="btn btn-secondary btn-lg">Edit</a>
                    </div>
                  </div>
            </div>
            </div>
        </div>
</div>
@endsection
