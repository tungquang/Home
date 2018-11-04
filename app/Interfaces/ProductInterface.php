<?php
namespace App\Interfaces;
/**
 *
 */
interface ProductInterface
{
  public function index();
  public function create();
  public function show($id);
  public function edit($datd);
  public function store($data);
  public function destroy($id);
}