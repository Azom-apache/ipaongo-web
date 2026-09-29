<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donations = Donation::with(['project', 'subcat', 'subsubcat'])->latest()->paginate(20);
        return view('admin.donations.index', compact('donations'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Donation $donation)
    {
        $donation->load(['project', 'subcat', 'subsubcat']);
        return view('admin.donations.show', compact('donation'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donation)
    {
        // Delete the associated image file if it exists
        if ($donation->image && file_exists(public_path('images/' . $donation->image))) {
            unlink(public_path('images/' . $donation->image));
        }

        if ($donation->delete()) {
            return redirect()->back()->with('success', 'Donation record deleted successfully.');
        }
        return redirect()->route('admin.donations.index');
    }
}
