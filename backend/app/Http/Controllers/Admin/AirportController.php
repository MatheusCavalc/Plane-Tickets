<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AirportController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $airports = Airport::all();

        return $this->response('All Airports', 200, $airports);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $slug = Str::slug($request->get('name'), '-');
        $request->request->add(['slug' => $slug]);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
        ]);

        if ($validator->fails()) return $this->error('Data Invalid', 422, $validator->errors());

        if ($validator->passes()) {
            $validatedData = $validator->validated();

            $airport = Airport::create($validatedData);

            if ($airport) return $this->response('Airport Created', 200, $airport);
        }

        return $this->error('Something Error', 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Airport $airport)
    {
        return $this->response('Airport', 200, $airport);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airport $airport)
    {
        $slug = Str::slug($request->get('name'), '-');
        $request->request->add(['slug' => $slug]);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required',
        ]);

        if ($validator->fails()) return $this->error('Data Invalid', 422, $validator->errors());

        if ($validator->passes()) {
            $validatedData = $validator->validated();
            $airport->update($validatedData);

            if ($airport) return $this->response('Airport Updated', 200, $airport);
        }

        return $this->error('Something Error', 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Airport $airport)
    {
        $airport->delete();

        return $this->response('Airport Deleted', 200, $airport);
    }
}
