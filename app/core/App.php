<?php

class App{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct(){
        $url = $this->parseURL();
        //cek Controller
        //cek apakah ada file di controllers yang namanya sesuai dengan url yang di masukan
        if(isset($url[0])){
        if( file_exists('../app/controllers/' . $url[0] . '.php') ){//file_exist = menegcek apakah ada file
            $this->controller = $url[0];
            unset($url[0]);//unset = menghapus array 
           }
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        //instansiasi controllernya
        $this->controller = new $this->controller;

        //cek method
        if ( isset($url[1]) ){
            if ( method_exists($this->controller, $url[1]) ){
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        //cek params
        if (!empty($url)){//!empty = tidak kosong / ada
            $this->params = array_values($url);//array values digunakan untuk mengambil data
        }

        //jalankan controller , method , serta kirimkan parms jika ada menggunakan function 
        call_user_func_array([$this->controller, $this->method] , $this->params);

    }

    public function parseURL(){
        if ( isset($_GET['url']) ){
            $url = rtrim($_GET['url'], '/') ; //rtrim untuk menghapus 
            $url = filter_var($url, FILTER_SANITIZE_URL);//FILTER_SANITIZE_URL untuk memfilter karakter spesial (!@#$% dll) 
            $url = explode( '/',$url ); // explode memecah string menjadi array
            return $url;
        }
    }

}