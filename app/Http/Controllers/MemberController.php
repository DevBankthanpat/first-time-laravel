<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use DateTime;

class MemberController extends Controller
{
    public function index() {  
        $members = Member::all();  
        return view('member', compact('members'));
    }

    public function create(){
        return view('form');
    }

    public function edit($id) {
        dd($id); 
    }

    public function delete($id) {
        $member = Member::find($id);
    
        if ($member) { 
            $member->delete(); 
    
            return redirect()->route('/')->with('success', 'Member deleted successfully');
        } else {
            return redirect()->route('/')->with('error', 'Member not found');
        }
    }

    public function add(Request $request) {
        $data = $request->validate([
            'prefix' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'dateofbirth' => 'required|date',
            'profile_picture' => 'image|max:2048',
        ]);
    
        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $imagePath;
        }

        $birthday = new DateTime($data['dateofbirth']);
        $today = new DateTime();
        $age = $today->diff($birthday); 

        $data['age'] = $age->y;
        $data['update_date'] = $today;
        $data['updated_at'] = $today;
        $data['created_at'] = $today;
    
        Member::create($data);
    
        return redirect()->route('members.index')->with('success', 'Member add successfully');
    }
}
