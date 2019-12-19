<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller {
        public function about() {
            $data = [];
            $data["first_name"] = "Nanaka";
            $data["last_name"] = "Horii";
            
        return view('pages.about', $data);
        }
        public function contact() {
        return view('contact');
        }

    }

