<?php 

namespace App\Traits;

use Storage;

trait StorageTrait
{
	public $storage;

	public function __construct(Storage $storage)
	{
		$this->storage = $storage;
	}
	public function getInf($file)
	{
		return [
			'name' =>time().'-'.$file->getClientOriginalName(),
			'size' =>$file->getClientSize(),
			'type' =>$file->guessClientExtension(),
		];
	}
	public function putFile($disk,$name,$file)
	{
		return Storage::disk($disk)
				->put($name,file_get_contents($file));
	}
} 