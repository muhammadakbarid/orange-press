<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends CI_Controller
{


  public function index()
  {
    $data['page'] = 'frontend/index';
    $data['title'] = 'Home';
    $this->load->view('template/frontend', $data);
  }

  public function about()
  {
    $data['page'] = 'frontend/about';
    $data['title'] = 'About';
    $this->load->view('template/frontend', $data);
  }

  public function features()
  {
    $data['page'] = 'frontend/features';
    $data['title'] = 'Features';
    $this->load->view('template/frontend', $data);
  }

  public function portofolio()
  {
    $data['page'] = 'frontend/portofolio';
    $data['title'] = 'Portofolio';
    $this->load->view('template/frontend', $data);
  }

  public function faq()
  {
    $data['page'] = 'frontend/faq';
    $data['title'] = 'Faq';
    $this->load->view('template/frontend', $data);
  }

  public function contact()
  {
    $data['page'] = 'frontend/contact';
    $data['title'] = 'Contact';
    $this->load->view('template/frontend', $data);
  }

  public function signin()
  {
    // $data['page']='auth/login';
    redirect('login');
  }

  public function signup()
  {
    $data['page'] = 'frontend/signup';
    $data['title'] = 'Signup';
    $this->load->view('template/frontend', $data);
  }
}
