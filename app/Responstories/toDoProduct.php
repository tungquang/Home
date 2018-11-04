<?php 
namespace App\Responstories;


use Validator;
use Response;
use App\Model\Product;
use App\Model\Price;
use App\Interfaces\ProductInterface;
use App\Traits\StorageTrait;
use Storage;

/**
 * 
 */
class toDoProduct implements ProductInterface
{
	use StorageTrait;
	function __construct(Product $product,Price $price)
	{
		$this->product 	= $product;
		$this->price 	= $price; 
	}
	public function index()
	{	
		$product =  $this->product->all();

		return view('admin.page.products.product-list')
					->with(['product'=>$product]);
	}
	public function create()
	{
		return 'create';
	}
	public function show($id)
	{
		return 'show';
	}
	public function edit($data)
	{
		return 'edit';
	}
	public function store($data)
	{	
		 $image = $this->getInf($data->file);
		
		$product = [
			'code'		=>$this->shortName($data->name),
			'name'		=>$data->name,
			'quantily'	=>$data->quantily,
			'image'		=>$image['name'],
		];

		$checkShortName = $this->check_shortName(
			$this->shortName($data->name)
		);
		// dd($checkShortName);
		if(!$checkShortName)
		{
			$product = $this->product->create($product);
			//put image to disk
			$this->putFile('local',$image['name'],$data->file);
			
			//create price of new product
			$this->price->create([
				'id_product' 	=>$product->id,
				'price'			=>$data->price1,
			]);
			$this->price->create([
						'id_product' 	=>$product->id,
						'price'			=>$data->price2,
					]);
			$view  = view('admin.page.products.product-list-render')
			 			->with(['pro' => $product])
						->render();
			return response()->json($view);			
		}
		else
		{
			return Response::json(['error' => 'Sản phẩm đã tồn tại']);
		}
		
		
	}
	public function destroy($id)
	{
		return response()->json($id);
	}
	protected function shortName($string)
	{
		$code = "";
		$stringConvert = $this->convertUTf8($string);
		
		$string = strtoupper($stringConvert);
		$explode = explode(" ",$string);
		foreach ($explode as $val) {
		 $code = $code.substr($val,0,1);
		 
		}
		return $code;
	}
	protected function convertUTf8($str)
	{
		if(!$str) return false;

		$utf8 = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ|Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',

         );

        foreach($utf8 as $ascii=>$uni) 
        	$str = preg_replace("/($uni)/i",$ascii,$str);
		return $str;
		
	}
	private function check_shortName($shorname)
	{
		return $this->product->getShortName($shorname);
	}

}