<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
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
            'title' => 'required|max:255',
            'subtitle' => 'nullable|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'description' => 'nullable|max:1000000',
            'content' => 'required',
            'order' => 'nullable|max:999',
            'slug' => 'required|alpha_dash|unique:pages'
        ]);


        if ($request->file('image')) {
            $file = $request->file('image');

            $fileNameWithExtension = $file->getClientOriginalName();

            $ModifiedFileNameWithoutExtension = Str::slug($data['title'], '_') . '_' . md5(microtime());

            $fileExtension = $file->getClientOriginalExtension();
            $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension . '.' . $fileExtension;

            $save_path = public_path('img/');
            $pathWithFileName = $save_path . $ModifiedFileNameWithExtension;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            $file->move($save_path, $ModifiedFileNameWithExtension);
        }


        $page = Page::create([
            'title' => $data['title'],
            'subtitle' => isset($data['subtitle']) ? $data['subtitle'] : null,
            'image' => isset($ModifiedFileNameWithExtension) ? $ModifiedFileNameWithExtension : null,
            'order' => isset($data['order']) ? $data['order'] : 1,
            'description' => isset($data['description']) ? $data['description'] : 'No Description Provided',
            'content' => $data['content'],
            'slug' => $data['slug'],
            'addedby_id' => Auth::id(),
            'editedby_id' => Auth::id(),
        ]);

        return back()->with('success', 'You have successfully created a Page.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'subtitle' => 'nullable|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'description' => 'nullable|max:1000000',
            'order' => 'nullable|max:999',
            'slug' => 'required|alpha_dash|unique:pages,slug,' . $page->id
        ]);

        if ($request->hasFile('image')) {
            function UnlinkImage($old_image)
            {
                // $old_image = $filepath.$fileName;
                if (file_exists($old_image)) {
                    @unlink($old_image);
                }
            }

            UnlinkImage(public_path('img/') . $page->image);

            $file = $request->file('image');

            $fileNameWithExtension = $file->getClientOriginalName();

            //$fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = Str::slug($data['title'], '_') . '_' . md5(microtime());

            // $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

            $fileExtension = $file->getClientOriginalExtension();
            $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension . '.' . $fileExtension;

            $save_path = public_path('img/');
            $pathWithFileName = $save_path . $ModifiedFileNameWithExtension;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            $file->move($save_path, $ModifiedFileNameWithExtension);
        }


        $page = tap($page)->update([
            'title' => $data['title'],
            'subtitle' => isset($data['subtitle']) ? $data['subtitle'] : $page->subtitle,
            'image' => isset($ModifiedFileNameWithExtension) ? $ModifiedFileNameWithExtension : $page->image,
            'order' => isset($data['order']) ? $data['order'] : 1,
            'description' => isset($data['description']) ? $data['description'] : 'No Description Provided',
            'slug' => $data['slug'],
            'editedby_id' => Auth::id(),
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'You have successfully updated a Page.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        function UnlinkImage($old_image)
        {
            if (file_exists($old_image)) {
                @unlink($old_image);
            }
        }

        UnlinkImage(public_path('img/') . $page->image);

        if ($page->delete()) {
            return redirect()->route('admin.pages.index')->with('success', 'You have successfully deleted a Page.');
        }

        return redirect()->route('admin.pages.index');
    }
}
