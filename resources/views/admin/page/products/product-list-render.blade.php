<tr>
  <td class="id hidden" >{{$pro->id}}</td>
  <td>{!!$pro->code!!}</td>
  <td>{{$pro->name}}</td>
  <td>{{$pro->quantily}}</td>
  <td>
    {{$pro->getPrice->first()->price}}
  </td>
  <td>
    {{$pro->getPrice->last()->price}}
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
