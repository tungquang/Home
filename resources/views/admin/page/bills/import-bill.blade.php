@extends('admin.layout')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Hóa đơn xuất hàng
      <small></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> {{config('app.name')}}</a></li>
      <li class="active"><a href="#">Hóa đơn xuất hàng</a></li>

    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Đắc Phú Sỹ</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                  title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body">

          <form action="{{route('import-bill-data')}}" method="get" id="improt-form">
             @csrf
            <table class="table table-hover">
            <div class="box-footer">
              <div class="">
                 Nội dung hóa đơn
              </div>
            </div>
            <thead>
              <tr>
                <th colspan="1">STT</th>
                <th colspan="3">Mã hàng</th>
                <th>Tên hàng</th>
                <th>Chiều dài</th>
                <th>Chiều rộng</th>
                <th>Số lượng</th>
                <th>Đơn vị</th>
                <th>Giá</th>
                <th>Thành tiền</th>
              </tr>
            </thead>
            <tbody>
              <tr class="product">
                <td colspan="1">1</td>
                <td colspan="3">
                  KT5
                  <input type="text" value="1" class="hidden id" name="">
                </td>
                <td>Kính trắng 5 ly</td>
                <td class="width-product">2.14</td>
                <td class="high-product">1.52</td>
                <td class="quan-product">
                   <input type="number" class="form-controll" min="0" name="quantity">
                </td>
                <td class="type">m2</td>
                <td class="price-product">
                  <select name="price">
                      <option value="1">15000</option>
                      <option value="2">20000</option>
                  </select>
                </td>
                <td class="total"></td>
              </tr>
              <tr class="product">
                <td colspan="1">2</td>
                <td colspan="3">
                  HDT
                  <input type="text" value="2" class="hidden id" name="">
                </td>
                <td>Kính hoa hải đường trắng</td>
                <td class="width-product">2.14</td>
                <td class="high-product">1.52</td>
                <td class="quan-product">
                  <input type="number" class="form-controll" min="1" name="quantity">
                </td>
                <td class="type">m2</td>
                <td class="price-product">
                  <select name="price">
                      <option value="1">30000</option>
                      <option value="2">50000</option>
                  </select>
                </td>
                <td class="total"></td>
              </tr>
            </tbody>
          </table>
          </form>
           <button type="submit" class="btn btn-primary" id="submit">Xuất hàng</button>

      </div>
      <!-- /.box-body -->

      <!-- /.box-footer-->
    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
@endsection
@section('title')
  {{config('app.name')." | Black"}}
@endsection
@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
      function total($product,$this)
      {
          $quan = parseFloat($product.children('.quan-product').children('input').val());
          $width = parseFloat($product.children('.width-product').text());
          $high = parseFloat($product.children('.high-product').text());
          $price = parseFloat($product.children('.price-product').children('select').children('option:selected').text());
          $acreage = $width * $high * $quan * $price;
          $product.children('.total').text($acreage);
      }
      $('.product').change(function(){
        total($(this));
      });
      // $('#submit').click(function(){
      //   event.preventDefault();
      //                         document.getElementById('improt-form').submit();
      // });
    });
  </script>
@endsection
