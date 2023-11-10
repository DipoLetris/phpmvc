<?php

class About {
    public function index($nama = 'Dipo', $pekerjaan = 'Mahasiswa'){
        echo "Hallo, nama saya $nama saya adalah $pekerjaan";
    }
    
    public function page(){
        echo 'About/page';
    }
}