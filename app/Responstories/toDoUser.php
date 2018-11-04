<?php
  namespace App\Responstories;

  use App\User;
  use App\Interfaces\UserInterface;
  /**
   *
   */
  class toDoUser implements UserInterface
  {

    function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index()
    {
      return $this->user->all();
    }
    public function show($id)
    {
      return $this->user->getById($id);
    }
    public function count()
    {
      return $this->user->count();
    }
    // public function store();
    // public function delete();
  }
