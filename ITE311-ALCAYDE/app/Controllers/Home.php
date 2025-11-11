<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('students/myCourses');
    }
      public function about(): string
    {
        return view('about');
    }
      public function contact(): string
    {
        return view('contact');
    }
     public function allUsers(): string
    {
        return view('allUser');
    }
    public function restricted(): string
    {
        return view('restricted');
    }
     public function notFound() {
        return view('error_page');
    }
}
