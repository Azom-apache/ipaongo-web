<?php

namespace App\Http\Controllers;

use App\Import;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentImportData;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.imports.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.imports.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "student_id" => "nullable",
            "id" => "nullable",
            "name" => "nullable"
        ]);

        if($request->hasFile('student_id')){
            
            $file = $request->file('student_id');
            $image = 'student_id'.time().'.'.$file->getClientOriginalExtension();
            request()->student_id->move(public_path('uploads/imports'), $image); 
            Excel::import(new StudentImportData, public_path('uploads/imports/'.$image));
            unlink(public_path('uploads/imports/'.$image));
            return back()->with('success',"<div class='alert alert-success'> Student Data Imported <div>");           
        }
        
        if(isset($data['id'])){
            Import::create([
                "student_name" => isset($data['name']) ? $data['name']:null,
                "student_code" => isset($data['id']) ? $data['id']:null
             ]); 
             return back()->with('success',"<div class='alert alert-success'>Student Id Added Successfully<div>");      
            
        }
         
    }
    
    
    public function addId(Request $request){
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Import  $import
     * @return \Illuminate\Http\Response
     */
    public function show(Import $import)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Import  $import
     * @return \Illuminate\Http\Response
     */
    public function edit(Import $import)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Import  $import
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Import $import)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Import  $import
     * @return \Illuminate\Http\Response
     */
    public function destroy(Import $import)
    {
        //
    }
}
