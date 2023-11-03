<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Member::with('sports')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:40',
            'last_name' => 'required|string|max:40',
            'image' => 'string|max:255',
            'sports' => 'array|nullable'
        ]);
 
        if ($validator->fails()) {
            return $validator->errors();
        };

        $validator->validate();

        $member = new Member();

        $member->first_name = $request->first_name;
        $member->last_name = $request->last_name;
        $member->image = $request->image;
        $member->save();
        
        $sports = $request->sports;
        if($sports) {
            $member->sports()->attach($sports);
            $member->save();
        }

        

        return $member;
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:40',
            'last_name' => 'required|string|max:40',
            'image' => 'string|max:255',
            'sports' => 'array|nullable'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        };

        $validator->validate();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return 'OK';
    }
}
