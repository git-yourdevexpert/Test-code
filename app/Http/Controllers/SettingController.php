<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\SettingRequest;

class SettingController extends Controller
{
     /**
     * Current page title
     *
     * @var string
     */
    public $_pageTitle = 'Settings';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.index',['setting'=>Setting::getAllSettings()]);
    }
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request)
    { 
        try{
            $setting =  Setting::where('user',Setting::$defultUserName)->first();
            $setting->update($request->all());
            return redirect()->back()->with('success',__('Setting has been updated'));
        } catch (\Execption $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }    
    }
}
