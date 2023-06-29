<?php

namespace App\Controllers;
use App\Models\UserModel;

class UserController extends BaseController
{
  protected $users;
  protected $validation;

  function __construct()
  {
    helper('form');
    $this->validation = \Config\Services::validation();
    $this->users = new UserModel();
  }

  public function index()
  {
    $data['users'] = $this->users->findAll();
    return view('pages/user_view', $data);
  }

  public function create()
  {
    $data = $this->request->getPost();
    $validate = $this->validation->run($data, 'user');
    $errors = $this->validation->getErrors();

    if(!$errors){
      $aktif = $this->request->getPost('is_aktif') == "on" ? 1 : 0;
      
      $dataForm = [ 
        'username' => $this->request->getPost('username'),
        'password' => md5( $this->request->getPost('password')[0] ),
        'role' => $this->request->getPost('role'),
        'is_aktif' => $aktif,
      ];
  
      $this->users->insert($dataForm);
  
      return redirect('users')->with('success','Data Berhasil Ditambah');
    }else{
      return redirect('users')->with('failed',implode("<br>",$errors));
    }   
  }

  public function edit($id)
  {
    $data = $this->request->getPost();
    $validate = $this->validation->run($data, 'user');
    $errors = $this->validation->getErrors();

    if(!$errors){
      $aktif = $this->request->getPost('is_aktif') == "on" ? 1 : 0;
      
      $dataForm = [ 
        'username' => $this->request->getPost('username'),
        'password' => $this->request->getPost('password'),
        'role' => $this->request->getPost('role'),
        'is_aktif' => $aktif,
      ];
      
      $this->users->update($id, $dataForm);

      return redirect('users')->with('success','Data Berhasil Diubah');
    }else{
      return redirect('users')->with('failed',implode("",$errors));
    }
  }

  public function delete($id)
  {
    $this->users->delete($id);
    return redirect('users')->with('success','Data Berhasil Dihapus');
  }
}