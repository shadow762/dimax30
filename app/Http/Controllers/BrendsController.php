<?php

namespace App\Http\Controllers;

use App\Models\Brend;
use Illuminate\Http\Request;

class BrendsController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function getBrends() {
        return json_encode(Brend::select('id', 'name')->get());
    }

    public function manageVue() {
        return view('manage-vue');
    }
    public function index(Request $request)

    {

        $items = Brend::latest()->paginate(5);


        $response = [

            'pagination' => [

                'total' => $items->total(),

                'per_page' => $items->perPage(),

                'current_page' => $items->currentPage(),

                'last_page' => $items->lastPage(),

                'from' => $items->firstItem(),

                'to' => $items->lastItem()

            ],

            'data' => $items

        ];


        return response()->json($response);

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
