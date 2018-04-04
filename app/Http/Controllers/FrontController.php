<?php

namespace App\Http\Controllers;

use App\Domain;
use App\DomainDNS;
use Illuminate\Http\Request;

use App\Http\Requests;

/**
 * Class FrontController
 * @package App\Http\Controllers
 */
class FrontController extends Controller
{

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dnsView($id, Request $request)
    {

        $domain = Domain::find($id);
        if ($dns = DomainDNS::where('domain_id', $id)->get()) {
            return view('domain_dns', compact('dns', 'domain'));
        }

        return view('404');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function dnsSave(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'type' => 'required',
        ]);
        $array = [];
        foreach($request->value as $key=>$value){
            if (!preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/', $value)) {
                return redirect()->back()->with('error', 'One Ip Address is not correct');
            }
        }
        foreach($request->id as $key=> $id){
            $array[$key]["id"] = $id;
        }
        foreach($request->domain_id as $key=> $domain_id){
            $array[$key]["domain_id"] = $domain_id;
        }
        foreach($request->name as $key=> $name){
            $array[$key]["name"] = $name;
        }
        foreach($request->type as $key=> $type){
            $array[$key]["type"] = $type;
        }
        foreach($request->value as $key=> $value){
            $array[$key]["value"] = $value;
        }

        foreach($array as $item){
            $save = DomainDNS::find($item["id"]);
            $save->domain_id = $item["domain_id"];
            $save->name = $item["name"];
            $save->type = $item["type"];
            $save->value = $item["value"];
            $save->save();
        }

        return redirect()->back()->with('message', "The update was successfully");
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveNewDNS(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'type' => 'required',
            'value' => 'required',
        ]);

        $value = $request->value;
        if (!preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/', $value)) {
            return response()->json('One Ip Address is not correct', 404);
        }


        $save = new DomainDNS();
        $save->domain_id = $request->id;
        $save->name = $request->name;
        $save->type = $request->type;
        $save->value = $request->value;
        $save->save();

        return response()->json('The new dns was added successfully', 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dnsDelete(Request $request)
    {
        if(!$request->id){
            return redirect()->back->with('error', 'This id was not found');
        }

        $domain = DomainDNS::destroy($request->id);
        if(!$domain){
            return redirect()->back->with('error', 'This id was not found');
        }

        return response()->json('Item was deleted', 200);
    }
}
