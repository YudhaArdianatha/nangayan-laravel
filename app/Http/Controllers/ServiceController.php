<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  public function __construct()
    //  {
    //      $this->middleware('auth');
    //  }

    public function index()
    {
        $services = Service::all();

        if (request()->ajax()){
            return response()->json($services);
        }

        return view('admin.services.services', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $validatedData = $request->validate([
            'service_name' => 'required|max:255',
            'service_description' => 'required',
            'service_price' => 'required',
        ]);

        $validatedData['slug'] = strtolower(str_replace(' ', '-', $validatedData['service_name']));

        // if (request()->ajax()){
        //     $updated = Service::create($validatedData);
        //     return response()->json($updated);
        // }

        Service::create($validatedData);

        if (request()->ajax()){
            return response()->json($validatedData);
        }

        return redirect('/services')->with('success', 'Service has been added!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $rules = [
          'service_name' => 'required|max:255',
          'service_description' => 'required',
          'service_price' => 'required',
        ];

        $validatedData = $request->validate($rules);

        $validatedData['slug'] = strtolower(str_replace(' ', '-', $validatedData['service_name']));

        // if (request()->ajax()){
        //     $updated = Service::where('id', $service->id)->update($validatedData);
        //     return response()->json($updated);
        // }

        Service::where('id', $service->id)->update($validatedData);

        if (request()->ajax()){
            return response()->json($validatedData);
        }

        return redirect('/services')->with('success', 'Service has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();

        if (request()->ajax()){
            return response()->json($service);
        }

        return redirect('/services')->with('success', 'Service has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Service::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
