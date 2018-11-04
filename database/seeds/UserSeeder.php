<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $user = new User();
            $user->create($this->radomUser(1));
            $user->create($this->radomUser(2));
            $user->create($this->radomUser(3));
            $user->create($this->radomUser(4));
            $user->create($this->radomUser(5));
            $user->create($this->radomUser(6));

    }
    public function radomUser($value)
    {
      $pass = '123456'.$value;
      $arr = [
                'name'        => 'TaTung'.$value,
                'email'       => 'tung9avh'.$value.'@gmail.com',
                'password'    => bcrypt($pass),
                'address'     => '120- Hai Ba Trung',
                'description' => '120 KTk',
              ];
      return $arr;
    }
}
