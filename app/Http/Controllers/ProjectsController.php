<?php

namespace App\Http\Controllers;

use App\Project;
use App\Gallery;
use Image;
use Auth;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $projects = Project::latest()->paginate(10);
        $projects = Project::orderBy('id', 'desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   //$parent = Project::where('status', 1)->get();
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function seo_friendly_url($string){
    //     $string = str_replace(array('[\', \']'), '', $string);
    //     $string = preg_replace('/\[.*\]/U', '', $string);
    //     $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    //     $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    //     $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    //     $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
    //     return strtolower(trim($string, '-'));
    // }

    public function store(Request $request)
    {
        $data = $request->validate([
            "parent" => "nullable",
            "subcat" => "nullable",
            "title" => "required",
            "price" => "nullable",
            // "status" => "required",
            "image" => "nullable|image|mimes:jpg,png,jpeg,gif",
            "short_desc" => "nullable",
            // "description" => "required",
            "gallery" => "nullable",
            "menu" => 'required',
        ]);
        $image = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = 'project_' . time() . '.' . $file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/project'), $image);
            $img = Image::read(public_path('uploads/project/' . $image))->resize(1280, 500);
            $img->save();
        }
        $slug = $this->seo_friendly_url($data['title']);
        if ($data['parent'] == null) {
            Project::create([
                "parent" => isset($data['parent']) ? $data['parent'] : 0,
                "title" => isset($data['title']) ? $data['title'] : null,
                "price" => isset($data['price']) ? $data['price'] : null,
                "slug" => $slug,
                "status" => isset($data['status']) ? $data['status'] : 1,
                "sideber_visible" => isset($data['sideber']) ? $data['sideber'] : 0,
                "short_desc" => isset($data['short_desc']) ? $data['short_desc'] : null,
                // "description" => isset($data['description']) ? $data['description']:null,
                "description" => $request->description,
                "image" => $image,
                "menu" => $request->menu,
                'create_id' => Auth::id()
            ]);
        } elseif (!empty($data['subcat']) && !empty($data['parent'])) {
            Project::create([
                "parent" => isset($data['subcat']) ? $data['subcat'] : $data['parent'],
                "title" => isset($data['title']) ? $data['title'] : null,
                "price" => isset($data['price']) ? $data['price'] : null,
                "slug" => $slug,
                "status" => isset($data['status']) ? $data['status'] : 1,
                "sideber_visible" => isset($data['sideber']) ? $data['sideber'] : 0,
                "short_desc" => isset($data['short_desc']) ? $data['short_desc'] : null,
                // "description" => isset($data['description']) ? $data['description']:null,
                "description" => $request->description,
                "image" => $image,
                "menu" => $request->menu,
                'create_id' => Auth::id()
            ]);
        } elseif (!empty($data['parent'])) {
            Project::create([
                "parent" => isset($data['parent']) ? $data['parent'] : $data['parent'],
                "title" => isset($data['title']) ? $data['title'] : null,
                "price" => isset($data['price']) ? $data['price'] : null,
                "slug" => $slug,
                "status" => isset($data['status']) ? $data['status'] : 1,
                "sideber_visible" => isset($data['sideber']) ? $data['sideber'] : 0,
                "short_desc" => isset($data['short_desc']) ? $data['short_desc'] : null,
                // "description" => isset($data['description']) ? $data['description']:null,
                "description" => $request->description,
                "image" => $image,
                "menu" => $request->menu,
                'create_id' => Auth::id()
            ]);
        }

        if (isset($data['gallery']) && $data['gallery'] == 'on') {
            // if($request->hasFile('image')){
            //     $file = $request->file('image');
            //     $image = 'member_'.time().'.'.$file->getClientOriginalExtension();
            //     request()->image->move(public_path('images/gallery'), $image);
            //     $img = Image::read(public_path('images/gallery/'.$image))->resize(1280,500);
            //     $img->save();
            // }
            $slug = $this->seo_friendly_url($data['title']);
            Gallery::create([
                "parent" => 0,
                "image" => $image,
                "title" => isset($data['title']) ? $data['title'] : null,
                'slug' => $slug
            ]);
        }
        return back()->with('success', 'Project Post Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            "parent" => "nullable",
            "title" => "required",
            "price" => "nullable",
            "sideber" => "nullable",
            // "status" => "required",
            "image" => "nullable|image|mimes:jpg,png,jpeg,gif",
            "gallery" => "nullable",
            "short_desc" => "nullable",
            "description" => "nullable"
        ]);
        $image = $project->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = 'project_' . time() . '.' . $file->getClientOriginalExtension();
            request()->image->move(public_path('uploads/project'), $image);
            $img = Image::read(public_path('uploads/project/' . $image));
            //->resize(1280,500);
            $img->save();
        }
        $slug = $this->seo_friendly_url($data['title']);
        // "parent"=> isset($data['parent']) ? $data['parent']:0,
        // "menu" => $request->menu,
        $project->update([
            "title" => isset($data['title']) ? $data['title'] : null,
            "price" => isset($data['price']) ? $data['price'] : null,
            "slug" => $slug,
            "sideber_visible" => isset($data['sideber']) ? $data['sideber'] : null,
            "status" => isset($data['status']) ? $data['status'] : null,
            "short_desc" => isset($data['short_desc']) ? $data['short_desc'] : null,
            "description" => isset($data['description']) ? $data['description'] : null,
            "image" => $image,
            "menu" => $request->menu,
            'order' => $request->order,
            'update_id' => Auth::id()
        ]);

        if (isset($data['gallery']) && $data['gallery'] == 'on') {
            // if($request->hasFile('image')){
            //     $file = $request->file('image');
            //     $image = 'member_'.time().'.'.$file->getClientOriginalExtension();
            //     request()->image->move(public_path('images/gallery'), $image);
            //     $img = Image::read(public_path('images/gallery/'.$image))->resize(1280,500);
            //     $img->save();
            // }
            $slug = $this->seo_friendly_url($data['title']);
            Gallery::create([
                "parent" => 0,
                "image" => $image,
                "title" => isset($data['title']) ? $data['title'] : null,
                'slug' => $slug
            ]);
        }

        return back()->with('success', '<div class="alert alert-success"> Project Post Updated Successfully </div>');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if (!empty($project->image) && $project->image != null) {
            if (file_exists(public_path('uplodas/project/' . $project->image))) {
                unlink(public_path('uploads/project/' . $project->image));
            }
        }
        $project->delete();
        return redirect()->route('dashboard.projects.index')->with('success', '<div class="alert alert-success"> Project Post Deleted Successfully </div>');
    }

    public function subcategory(Request $request)
    {

        if (!empty($request->id)) {
            $project = Project::where('parent', $request->id)->get();
            return response()->json($project);
        }
        if (!empty($request->subcat)) {
            $project = Project::where('parent', $request->subcat)->get();
            echo '<label>Sub Sub Project</label>
                <select  class="form-control">
                    <option value=""> --Sub Sub Project-- </option>';
            foreach ($project as $item) {
                echo '<option value="' . $item->id . '">' . $item->title . '</option>';
            }
            echo '</select>';
        }
    }

    public function project_data(Request $request)
    {
        dd($request);
    }
    public function seo_friendly_url($string)
    {
        $string = str_replace(array('[\', \']'), '', $string);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
        $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $string);
        return strtolower(trim($string, '-'));
    }
}
