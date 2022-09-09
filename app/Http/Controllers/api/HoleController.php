<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class HoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $hole_data = json_decode($request->hole_data, true);
            DB::table('holes')
                ->where('id', $hole_data['id'])
                ->update($hole_data);
            $hole = DB::table('holes')->where('id', $hole_data['id'])->first();
            return response()->json(['hole' => $hole], 200);
        } catch (\exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateTeebox(Request $request)
    {
        try {
            $hole_data = json_decode($request->hole_data, true);
            $course_id = $hole_data['course_id'];
            $teebox = $hole_data['teebox'];
            $new_teebox = $hole_data['new_teebox'];
            
            $holes = DB::table('holes')
                        ->where([['course_id', $course_id], ['teebox', $teebox]])
                        ->get();
            foreach ($holes as $hole) {
                DB::table('holes')
                    ->where('id', $hole->id)
                    ->update(['teebox' => $new_teebox]);
            }
            return response()->json(['success' => 'teebox name was updated'], 200);
        } catch (\exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
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
