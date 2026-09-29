<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('view', Brand::class);
        $brands = Brand::latest()->get();
        return view('admin.brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', Brand::class);
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $this->authorize('create', Brand::class);

        $data = $request->validate([
            'title' => 'required|unique:brands|max:255'

        ]);


        $brand=Brand::create([
            'title' => $data['title'],
            'slug' => str_slug($data['title'], '-'),
            'addedby_id' => \Auth::id(),
            'editedby_id' => \Auth::id(),
        ]);


        $brand = tap($brand)->update([
            'order' => Brand::count()
        ]);


        return back()->with('success','You have successfully added a brand.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        // $this->authorize('update', Brand::class);
        return view('admin.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        // $this->authorize('update', Brand::class);
        $data = $request->validate([
            'title' => 'required|max:255|unique:brands,title,'.$brand->id,
            'order' => 'nullable|integer|max:10000',
        ]);


        $brands = tap($brand)->update([
            'title' => $data['title'],
            'slug' => str_slug($data['title'], '-'),
            'order' => isset($data['order']) ? $data['order'] : $brand->order,
            'editedby_id' => \Auth::id(),
        ]);

        return redirect()->route('admin.brands.index')->with('success','You have successfully updated a brand.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        // $this->authorize('delete', Brand::class);
        if ($brand->delete()) {
            return redirect()->route('admin.brands.index')->with('success','You have successfully deleted a Brand.');
        }
        return redirect()->back();
    }
}
