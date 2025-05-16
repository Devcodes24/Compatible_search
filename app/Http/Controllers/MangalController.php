<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MangalController extends Controller
{
    //
    public function mangalshow(Request $request)
    {
        // Retrieve the location from the request.

        //dd($request->all());
        if ($request->isMethod('post')) {
            //  Data came from a form submission (POST)
            $data = $request->all();  // Get all data
            Log::info('Data from POST: ' . print_r($data, true));
            //  Process the form data here
             return response()->json([
                    'message' => 'Data recieved from post',
                    'data'    => $data
                ]);

        } elseif ($request->isMethod('get')) {
            //  Data came from a link click or URL access (GET)
            $data = $request->query(); // Get data from the query string
             Log::info('Data from GET: ' . print_r($data, true));
             return response()->json([
                    'message' => 'Data recieved from get',
                    'data'    => $data
                ]);
        }
        else{
             Log::info('No Data ');
             return response()->json([
                    'message' => 'No Data'
                ]);
        }

        //  Example:  Get a specific input (works for both GET and POST)
        //$location = $request->input('location');
        //Log::info('Location: ' . $location);

        //  Your mangalshow logic here...
        //  For now, just return a response
    }
}
