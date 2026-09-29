<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = array
        (
            'users' => DB::table('users')->count(),
            'categories' => DB::table('categories')->where('level', 1)->count(),
            'subcategories' => DB::table('categories')->where('level', 2)->count(),
            'subchildcategories' => DB::table('categories')->where('level', 3)->count(),
            'brands' => DB::table('brands')->count(),
            'offers' => DB::table('offers')->count(),
            'products' => DB::table('products')->count(),
            'pendingOrders'=> DB::table('orders')->where('status', 'pending')->count(),
            'confirmedOrders'=> DB::table('orders')->where('status', 'confirmed')->count(),
            'soldOrders'=> DB::table('orders')->where('status', 'sold')->count(),
            'cancelledOrders'=> DB::table('orders')->where('status', 'cancelled')->count(),
            'todayOrders' => Order::latest()->whereDate('created_at', Carbon::today())->count(),
            'weekOrders' =>  Order::latest()->whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])->count(),
            'monthOrders' =>  Order::latest()->where('created_at', '>=', Carbon::now()->startOfMonth())->count(),
            'yearOrders' =>  Order::latest()->where('created_at', '>=', Carbon::now()->startOfYear())->count(),
        );

        return view('admin.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
