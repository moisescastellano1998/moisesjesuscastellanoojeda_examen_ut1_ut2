<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;


class FormController extends Controller
{
    public function loadForm(){
        return view('formulario');
    }
    public function manageData(Request $request){
        $datos=$request->validate([
            'subrayado'=>'required',
            'negrita'=>'required',
            'message'=>'required|regex:/^\w+.{0,299}/',
        ],[
            'subrayado.required'=>'*Debes indicar si quieres subrayado o no.',
            'negrita.required'=>'*Debes indicar si quieres negrita o no.',
            'message.required'=>'*Debes escribir un mensaje.',
            'message.regex'=>'*El mensaje no cumple el formato requerido. Debe empezar con una letra o número y tener 300 caracteres como máximo.'
        ]);

        $this->insertData($datos);
        return redirect()->route('load.form')->with("ok",true);
    }


    public function insertData($datos){
        Message::create(['text'=>$datos['message'], 'subrayado'=>$datos['subrayado'], 'negrita'=>$datos['negrita']]);
    }

    public function getMessage($id){
        return Message::find($id);
    }

    public function editMessage(Request $request, $id){
        $datos=$request->validate([
            'subrayado'=>'required',
            'negrita'=>'required',
            'message'=>'required|regex:/^\w+.{0,299}/',
        ],[
            'subrayado.required'=>'*Debes indicar si quieres subrayado o no.',
            'negrita.required'=>'*Debes indicar si quieres negrita o no.',
            'message.required'=>'*Debes escribir un mensaje.',
            'message.regex'=>'*El mensaje no cumple el formato requerido. Debe empezar con una letra o número y tener 300 caracteres como máximo.'
        ]);

        $message=$this->getMessage($id);
        $message->text=$datos['message'];
        $message->subrayado=$datos['subrayado'];
        $message->negrita=$datos['negrita'];
        $message->save();

        return redirect()->route('load.messages');
    }
}
