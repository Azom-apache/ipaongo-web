<?php

namespace App\Http\Controllers\Admin;

use App\QuestionAnswer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionsAnswers = QuestionAnswer::latest()->get();
        return view('admin.questionsanswers.index', compact('questionsAnswers'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        $questionsAnswers = QuestionAnswer::latest()->where('status',false)->get();
        return view('admin.questionsanswers.pending', compact('questionsAnswers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.pages.create');
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
            'order' => 'nullable|max:999',
            'slug' => 'required|alpha_dash|unique:pages'
        ]);


        if($request->file('image')) {
            $file = $request->file('image');

            $fileNameWithExtension = $file->getClientOriginalName();

            //$fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
            $ModifiedFileNameWithoutExtension = str_slug($data['title'], '_').'_'.md5(microtime());

            // $fileExtension = pathinfo($fileNameWithExtension, PATHINFO_EXTENSION);

            $ModifiedFileNameWithExtension = $ModifiedFileNameWithoutExtension.'.jpg';

            $image = \Image::read($file->getRealPath());
            $save_path=public_path('img/');
            $pathWithFileName = $save_path.$ModifiedFileNameWithExtension;

            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            $image->encode('jpg', 100)->save($pathWithFileName);
        }


        $page = Page::create([
            'title' => $data['title'],
            'subtitle' => isset($data['subtitle']) ? $data['subtitle'] : null,
            'image' => isset($ModifiedFileNameWithExtension) ? $ModifiedFileNameWithExtension : null,
            'order' => isset($data['order']) ? $data['order'] : 1,
            'description' => isset($data['description']) ? $data['description'] : 'No Description Provided',
            'slug' => $data['slug'],
            'addedby_id' => Auth::id(),
            'editedby_id' => Auth::id(),
        ]);

        return back()->with('success','You have successfully created a Page.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionAnswer $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionAnswer $question)
    {
        return view('admin.questionsanswers.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionAnswer $question)
    {
        $data = $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required|max:1000',
            'status' => 'required|boolean',
        ]);

        $question = tap($question)->update([
            'question' => $data['question'],
            'answer' => $data['answer'],
            'status' => $data['status'],
            'ansby_id' => Auth::id(),
        ]);

        return redirect()->route('admin.questionanswer.index')->with('success','You have successfully updated a Question Answer.');
    }

       /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, QuestionAnswer $question)
    {
        $question = tap($question)->update([
            'status' => true,
        ]);

        // return redirect()->route('admin.reviews.index')->with('success','You have successfully approved a review.');
        return back()->with('success','You have successfully approved a question.');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disapprove(Request $request, QuestionAnswer $question)
    {
        $question = tap($question)->update([
            'status' => false,
        ]);

        // return redirect()->route('admin.reviews.index')->with('success','You have successfully disapproved a review.');
        return back()->with('success','You have successfully disapproved a question.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionAnswer $question)
    {
        function UnlinkImage($old_image)
        {
            if (file_exists($old_image)) {
               @unlink($old_image);
            }
        }

        UnlinkImage(public_path('img/').$page->image);

        if ($page->delete()) {
            return redirect()->route('admin.pages.index')->with('success','You have successfully deleted a Page.');
        }

        return redirect()->route('admin.pages.index');
    }
}
