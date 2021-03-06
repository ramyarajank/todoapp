<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Auth;
use App\User;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    //List all todo content
    public function index()
    { 
        if(Auth::user()){
            $items = Item::all();
            $completed = Item::where('status','=','1')->count();
            $pending = Item::where('status','=','0')->count();

            return view('list', compact('items','pending','completed'));
        }else{
            return redirect('/');
        }
    }

    //Create a new Item to the list
    public function create(Request $request)
    {
        $item = new Item;
        $item->item = $request->text;
        $item->status = $request->status;
        $item->save();
        return 'created';
    }
    
    //Delete a Item from the list
    public function delete(Request $request)
    {
        $item = Item::find($request->id);
        $item->delete();
        return "deleted";
    }

    //Update the Item
    public function update(Request $request)
    {
        $item = Item::find($request->id);
        $item->item = $request->value;
        $item->status = $request->status;
        $item->save();
        return $request->all();
    }

}
