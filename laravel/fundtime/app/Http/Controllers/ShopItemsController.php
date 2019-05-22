<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopItem;
use Auth;
use App\User;

class ShopItemsController extends Controller
{
    /**
      * Create a new controller instance.
      *
      * @return void
      */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getIndex()
    {
        $shop_items = ShopItem::all();
        return view('shop.index', compact('shop_items'));
    }

    public function postConfirmed()
    {
        $user = Auth::user();
        //cleint id update
        $total_f = (request("total_f")) ? request('total_f') : null;
        $total_user_f = $total_f + $user->credits;

        $user->credits = $total_user_f;

        $user->save();



        return view('shop.confirmed', compact('total_f', 'total_user_f'));
    }
}
