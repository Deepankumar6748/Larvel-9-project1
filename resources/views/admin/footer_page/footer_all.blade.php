@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">About Page </h4>
                        <form  method="POST" action="{{route('update.footer')}}" >
                            @csrf    <!--A CSRF token is a unique, secret, and unpredictable value that is generated by the server-side application and shared with the client. When issuing a request to perform a sensitive action, such as submitting a form, the client must include the correct CSRF token-->
                            <input type="hidden" name="id" value="{{$footerpage->id}}">  <!-- Here we get the id value as hidden-->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Number</label>
                            <div class="col-sm-10">
                                <input name="number" class="form-control" type="text" value="{{ $footerpage->number }}" id="example-text-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Short Description</label>
                            <div class="col-sm-10">
                                <textarea required="" name="short_description" class="form-control" rows="5">{{$footerpage->short_description}}</textarea>
                              </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <textarea required="" name="address" class="form-control" rows="5">{{$footerpage->address}}</textarea>
                              </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input name="email" class="form-control" type="text" value="{{ $footerpage->email }}" id="example-text-input">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Facebook</label>
                            <div class="col-sm-10">
                                <input name="facebook" class="form-control" type="text" value="{{ $footerpage->facebook }}" id="example-text-input">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Twitter</label>
                            <div class="col-sm-10">
                                <input name="twitter" class="form-control" type="text" value="{{ $footerpage->twitter }}" id="example-text-input">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Copyrights</label>
                            <div class="col-sm-10">
                                <input name="copyrights" class="form-control" type="text" value="{{ $footerpage->copyrights }}" id="example-text-input">
                            </div>
                        </div>
                        <input class="btn btn-primary" value="Update Footer Page" type="submit">
                    </form>
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection