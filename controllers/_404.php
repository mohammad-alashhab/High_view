<?php

class _404 extends  Controllers
{
    public function index(){
        $this->view('pages/blog');
    }
}

$_404 = new _404();
$_404->index();