<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Models\User;
use App\Models\Agent;
use App\Models\Country;
use App\Models\State;

class AgentController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // dd(Auth::user()->user_type);
            $agents = User::where('user_type', 'agent')->get();
            return view('agents.list', compact('agents'));
        }
        return redirect("login");
    }

    public function create()
    {
        if (Auth::check()) {
            $countries = Country::get(['id', 'name']);
            return view('agents.create', compact('countries'));
        }
        return redirect("login");
    }

    public function save(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required|min:6',
                'phone' => 'required',
                'company_name' => 'required',
                'address1' => 'required',
                'country_id' => 'required',
                'province_id' => 'required',
                'city' => 'required',
                'website' => 'required',
            ]);

            $user_data = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'user_type' => 'agent',
                'status' => $request->status
            );
            $user_id = User::create($user_data)->id;

            $agent_data = array(
                'user_id' => $user_id,
                'company_name' => $request->company_name,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'country_id' => $request->country_id,
                'province_id' => $request->province_id,
                'city' => $request->city,
                'website' => $request->website
            );
            Agent::create($agent_data);
            return redirect("agents")->with('success', 'Agent Created successfully');
        }
        return redirect("login");
    }

    public function edit($id)
    {
        if (Auth::check()) {
            $agent = User::join('agents', 'users.id', '=', 'agents.user_id')
                ->where('users.id', $id)->get();
            $countries = Country::get(['id', 'name']);
            $provinces = State::get()->where('country_id', $agent[0]->country_id);
            return view('agents.edit', compact('agent', 'countries', 'provinces'));
        }
        return redirect("login");
    }

    public function update(Request $request, $id)
    {
        if (Auth::check()) {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
                'company_name' => 'required',
                'address1' => 'required',
                'country_id' => 'required',
                'province_id' => 'required',
                'city' => 'required',
                'website' => 'required',
            ]);
            /*$data = $request->all();
            dd($data);*/
            $user_data = array(
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'status' => $request->status
            );
            User::whereId($id)->update($user_data);

            $agent_data = array(
                'company_name' => $request->company_name,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'country_id' => $request->country_id,
                'province_id' => $request->province_id,
                'city' => $request->city,
                'website' => $request->website
            );
            Agent::where('user_id', $id)->update($agent_data);
            return redirect("agents")->with('success', 'Agent Updated successfully');
        }
        return redirect("login");
    }

    public function destroy($id)
    {
        if (Auth::check()) {
            User::where('id', $id)->delete();
            Agent::where('user_id', $id)->delete();
            return redirect("agents")->with('danger', 'Agent Deleted successfully');
        }
        return redirect("login");
    }

    public function fetch_provinces(Request $request)
    {
        $data['provinces'] = State::where("country_id", $request->country_id)->get(['id', 'name']);
        return response()->json($data);
    }
}
