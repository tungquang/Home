@extends('admin.layout')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Quản lý người dùng
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> {{config('app.name')}}</a></li>
      <li class="active"><a href="#">Danh sách người dùng</a></li>

    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Danh sách người dùng</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <table class="table table-hover">
          <div class="box-footer">
            Số bản ghi : {{$list->count()}}
          </div>
          <thead>
            <tr>
              <th>Tên</th>
              <th>Tài khoản</th>
              <th>Địa chỉ</th>
              <th>Miêu tả</th>
            </tr>
          </thead>
          <tbody>
            @foreach($list as $l)
              <tr>
                <td>{{$l->name}}</td>
                <td>{{$l->email}}</td>
                <td>{{$l->address}}</td>
                <td>{{$l->description}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->

      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->

@endsection
@section('title')
  {{config('app.name')." | Black"}}
@endsection
