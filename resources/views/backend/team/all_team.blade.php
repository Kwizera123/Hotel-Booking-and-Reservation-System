@extends('admin.admin_dashboard')
@section('admin')




  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

    <div class="ps-3">
      <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <a href="{{ route('add.team') }}" class="btn btn-outline-primary px-5 radius-30">Add Team Mamber</a>
      </ol>
      </nav>
    </div>

    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">All Team Mambers</h6>
    <hr />
    <div class="card">
    <div class="card-body">
      <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
          <th>SL</th>
          <th>Image</th>
          <th>Name</th>
          <th>Position</th>
          <th>Facebook</th>
          <th>Tweeter</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($team as $key => $item)
      <tr>
        <td>{{ $key + 1}}</td>
        <td>
        <img src="{{asset($item->image) }}" alt="Image" style="width:40px ; height=:40px;">
        </td>
        <td>{{ $item->name}}</td>
        <td>{{ $item->position }}</td>
        <td>{{ $item->facebook }}</td>
        <td>{{ $item->tweeter }}</td>
        <td>
        <a href="{{ route('edit.team', $item->id)}}" class="btn btn-success px-3 radius-30">Edit</a>
        <a href="{{ route('delete.team', $item->id)}}" class="btn btn-danger px-3 radius-30"
        id="delete">Delete</a>
        </td>
      </tr>
      @endforeach
        </tbody>

      </table>
      </div>
    </div>
    </div>

    <hr />

  </div>


@endsection