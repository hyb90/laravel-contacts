<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Contact;

Route::group(['middleware'=>'api'], function(){
    //fetch contacts
    Route::get('contacts',function(){
        return Contact::latest()->orderBy('created_at','desc')->get();
    });
    //fetch single contact
    Route::get('contact/{id}',function($id){
        return Contact::findOrFail($id);
    });
    //add contact
    Route::post('contact/store',function(Request $request){
        return Contact::create([
            'name'=>$request->input(['name']),
            'email'=>$request->input(['email']),
            'phone'=>$request->input(['phone']),
            ]);
    });
    //update contact
    Route::patch('contact/update/{id}',function(Request $request,$id){
        return Contact::findOrFail($id)->update([
            'name'=>$request->input(['name']),
            'email'=>$request->input(['email']),
            'phone'=>$request->input(['phone']),
            ]);
    });
    //delete contact
    Route::delete('contact/delete/{id}',function($id){
        return Contact::destroy($id);
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
