@extends('admin.layout')
@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Quản lý sản phẩm
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> {{config('app.name')}}</a></li>
      <li class="active"><a href="#">Danh sách sản phẩm</a></li>

    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Danh sách sản phẩm</h3>
        <div>
          <button class="btn btn-primary btn-small" data-toggle="modal" data-target="#createProduct">Tạo mới sản phẩm</button>
      

         <!-- Modal  create product-->
        <div class="modal fade" id="createProduct" role="dialog">
          <div class="modal-dialog">
          
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tạo mới sản phẩm</h4>
              </div>
              <div class="modal-body">
                  <div class="box box-primary">
                    <form role="form" enctype="multipart/form-data" id="form-data" action="" method="post">
                      @csrf
                      <div class="box-body">
                        <div class="form-group">
                          <label for="name-product">Tên sản phẩm</label>
                          <input type="text" name="name"  id="name-product" class="form-control" placeholder="Kính trắng 5 ly">
                        </div>
                        <div class="form-group">
                          <label for="quantily-product">Số lượng</label>
                          <input name="quantily" type="number" id="quantily-product"  class="form-control" placeholder="15">
                        </div>
                        
                        <div class="form-group">
                          <label for="price1">Giá bản lẻ</label>
                          <input type="text" name="price1" id="price1" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="price2">Giá bán lô</label>
                          <input type="text" name="price2" id="price2" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="image-product">Ảnh sản phẩm</label>
                          <input type="file" name="image" id="image-product" class="form-control">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      
                    </form>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
            
          </div>
        </div>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div id="alert" class="hidden" style="width: 17.5%;">
          
        </div>
        <table class="table hover-table">
          <thead>
            <tr>
              <th>Mã sản phẩm</th>
              <th>Tên sản phẩm</th>
              <th>Số lượng sản phẩm</th>
              <th>Giá sản phẩm bán lẻ</th>
              <th>Giá sản phẩm bán lô</th>
              <th>Xem tương tác</th>
              <th>Miêu tả</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody id="list">
            @foreach($product as $pro)
            <tr>
              <td class="id hidden">{{$pro->id}}</td>
              <td>{!!$pro->code!!}</td>
              <td>{{$pro->name}}</td>
              <td>{{$pro->quantily}}</td>
              <td>
                {{$pro->getPrice->first()->price}}
              </td>
              <td>{{$pro->getPrice->last()->price}}
              </td>
              <td>
                <?php 
                  if($pro->view)
                  {
                    echo "Có";
                  }
                  else
                      echo "Không";

                ?>
                
              </td>
              <td>{{$pro->description}}</td>
              <td>
                <button class="delete btn btn-danger">Xóa bản ghi</button>
                <button class="edit btn btn-primary">Chỉnh bản ghi</button>
              </td>
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

@section('script')
  <script>
    $('#submit').click(function(){
      
      var form_data = new FormData();
      var file_Data = $('#image-product').prop('files')[0];
      var name = $("input[name=name]").val();
      var number = $("input[name=number]").val();
      var quantily = $("input[name=quantily]").val();
      var price1 = $("input[name=price1]").val();
      var price2 = $("input[name=price2]").val();

      form_data.append('name', name);
      form_data.append('number', number);
      form_data.append('quantily', quantily);
      form_data.append('price1', price1);
      form_data.append('price2', price2);
      
      form_data.append('file', file_Data);

      $.ajax({
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
        url: '{{route('product-add')}}',
        type: 'post',
        contentType: false,
        processData: false,
        data: form_data,
        
        success: function($data)
        {
          if ($data.error) {
            alert($data.error);
          }
          else
          {
            $("#success").attr("class","");
            $("#success").append("<p class='alert alert-success'>Thêm thành công !</p>");

            $("#list").append($data);
          }
        }
      });  
    });
    $('.delete').click(function(){
        $id = $(this).parent().parent().children(".id").text();
        $.ajax({

          url: "{{url('product/')}}/"+$id,

          type:'DELETE',
          success:function($data)
          {
            console.log($data);
          }
        });
    });
    
  </script>
@endsection 