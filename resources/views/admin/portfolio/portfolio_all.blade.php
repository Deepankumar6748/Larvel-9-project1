@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">All Portfolio</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">All Portfolio</h4>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Portfolio Name</th>
                                <th>Portfolio Title</th>
                                <th>Portfolio Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>


                            <tbody>
                                @php($i=1)
                                @foreach ($portfolio as $item)
                            <tr>
                                <td>{{ $i++}}</td>
                                <td>{{ $item->portfolio_name}}</td>
                                <td>{{ $item->portfolio_title}}</td> <!--Here we increasing the i value for each loop.  for that we initialized it-->
                                <td><img src="{{asset($item->portfolio_image)}}" style="width: 50px;height:50px" alt=""></td>
                                <td>
                                    <a href="{{route('edit.portfolio',$item->id)}}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>  <!--title value is shown if we place the cursor on the icon.HEre we pass with the id so that which id value is to edited is know-->
                                    <a href="{{route('delete.portfolio',$item->id)}}" class="btn btn-danger sm" id="delete" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>

@endsection
