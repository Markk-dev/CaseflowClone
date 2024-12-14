<?php
  namespace App\Controllers;

  use App\Models\UserModel;
  
  class Auth extends BaseController {
      public function register() {
          return view('register');
      }
  
      public function registerUser() {
          $validation = \Config\Services::validation();
          $validation->setRules([
              'lname' => 'required|alpha_space',
              'fname' => 'required|alpha_space',
              'email' => 'required|valid_email|regex_match[/^[a-zA-Z0-9._%+-]+@gmail\.com$/]',
              'password' => 'required|min_length[8]|regex_match[/[A-Z]/]|regex_match[/[!@#$%^&*()_+]/]',
              'confirm_password' => 'matches[password]'
          ]);
  
          if (!$this->validate($validation->getRules())) {
              return redirect()->to('register')->withInput()->with('errors', $this->validator->getErrors());
          }
  
          $userModel = new UserModel();
          $userModel->save([
              'lname' => $this->request->getPost('lname'),
              'fname' => $this->request->getPost('fname'),
              'email' => $this->request->getPost('email'),
              'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
          ]);
  
          return redirect()->to('login');
      }
  
      public function login() {
          return view('login');
      }
  
      public function loginUser() {
        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();
    
        if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
            
            session()->set([
                'user_id' => $user['id'],
                'role'    => $user['role'],
                'fname'   => $user['fname'], 
            ]);
            return redirect()->to('dashboard'); 
        }
    
        
        return redirect()->to('login')->with('error', 'Invalid login credentials');
    }
    
  }