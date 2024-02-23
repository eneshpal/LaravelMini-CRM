<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Session;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Companies::get();
        return view('companies.index',compact('data'));
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
    
    public function store(Request $request)
    {
       // dd($request->all());

        $request->validate([
            'name' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);
    
       
        $imageData = $request->file('logo');

        //$imageName = time() . '.' . $request->logo->getClientOriginalExtension();
        $filename = uniqid('image_') . '.' . $imageData->getClientOriginalExtension();
        
        if ($imageData->storeAs('public/company_logo/', $filename)) {
            
            $insertData = [
                'name' => $request->name,
                'email' => $request->email,
                'logo' => $filename,
                'website' => $request->website,
                'created_at' => Carbon::now(),
            ];

            

           // dd($insertData);
    
            if (DB::table('companies')->insert($insertData)) {
                return redirect()->back()->with('message', 'Company created successfully.');
            } else {
                return redirect()->back()->with('error', 'Company creation failed.')->withInput();
            }
        } else {
            return redirect()->back()->with('error', 'Failed to upload image.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Companies $companies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Companies $companies)
    {
        $id = $request->id;

        $request->validate([
            'name' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
        ]);
    
        $data = DB::table('companies')->where('id', $id)->first();
    
        if(!$data) {
            return redirect()->back()->with('error', 'Data not found.');
        }
    
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            //'logo' => $request->email,
            'website' => $request->website,
            
        ];
    
        if ($request->hasFile('logo')) {
            $filename = uniqid('image_') . '.' . $imageData->getClientOriginalExtension();
            $imageData->storeAs('public/company_logo/', $filename);
            $updateData['logo'] = $imageName;
        } else {
            $updateData['logo'] = $data->logo;
        }
    
        $updateSuccess = DB::table('companies')->where('id', $id)->update($updateData);
    
        return $updateSuccess 
            ? redirect()->back()->with('message', 'Data updated successfully.')
            : redirect()->back()->with('error', 'Data has not made any updates.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Companies $companies)
    {
        $delet = DB::table('companies')->where('id', $companies)->delete();
    
        if ($delet) {
            return redirect()->back()->with('message', 'Company Deleted Successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to delete user');
        }
    }
}
