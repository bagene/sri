<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Site; // Site Model
use App\Http\Controllers\Controller;
use Session;

class SitesController extends Controller
{
  public function __construct(){
    $this->middleware(['auth','admin']);
  }

  public function index(){

    $search = \Request::get('search'); //<-- we use global request to get the param of URI

    $sites = Site::where('name','like','%'.$search.'%')
        ->orWhere('address','like','%'.$search.'%')
        ->orderBy('name')
        ->paginate(5);

    return view('sites.index',compact('sites'));
  }

  public function create(){

    return view('sites.create');
  }

  public function edit($id){

    $site = Site::findOrFail($id);
    return view('sites.edit',compact('site'));
  }


  public function store(Request $request){

    $this->validate($request,[
      'name' => 'required|unique:sites,name',
      'address' => 'required'
    ]);

    $input = $request->all();
    Site::create($input);
    Session::flash('flash_message','Site Successfully Created');
    return redirect('sites');

  }

  public function update($id,Request $request){

    $input = $request->all();
    $site = Site::findOrFail($id);

    if($site->name == $input['name']){

      $this->validate($request,[
        'name' => 'required',
        'address' => 'required'
      ]);

    }else{
      $this->validate($request,[
        'name' => 'required|unique:sites,name',
        'address' => 'required'
      ]);
    }

    $site->fill($input)->save();
    Session::flash('flash_message','Site Successfully Updated');
    return redirect('sites');


  }

  public function destroy($id){

    $site = Site::findOrFail($id);
    $site->delete();

    Session::flash('flash_message','Site Successfully Deleted');
    return redirect('sites');

  }
}
