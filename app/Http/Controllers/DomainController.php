<?php

namespace App\Http\Controllers;

use App\Domain;
use Illuminate\Http\Request;

use App\Http\Requests;

/**
 * Class DomainController
 * @package App\Http\Controllers
 */
class DomainController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $domains = Domain::all();

        return view('welcome', compact("domains"));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        $array = [];

        foreach($request->id as $key=> $id){
            $array[$key]["id"] = $id;
        }
       
        foreach($request->name as $key=> $name){
            $array[$key]["name"] = $name;
        }


        foreach($array as $item){
            $save = Domain::find($item["id"]);
            $save->name = $item["name"];
            $save->save();
        }

        return redirect()->back()->with('message', "The domain was successfully updated");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveDomain(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $save = new Domain();
        $save->name = $request->name;
        $save->save();

        return response()->json('The new domain was added successfully', 200);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function Delete(Request $request)
    {
        if(!$request->id){
            return response()->json('This id was not found', 404);
        }

        $domain = Domain::destroy($request->id);
        if(!$domain){
            return response()->json('This id was not found', 404);
        }

        return response()->json('Item was deleted', 200);
    }


}
