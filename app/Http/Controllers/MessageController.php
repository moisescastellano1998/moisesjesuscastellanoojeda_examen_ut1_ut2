<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function editForm($id){
        return view('formulario')->with("message", Message::find($id));
    }
}
