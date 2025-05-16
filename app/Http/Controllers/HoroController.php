<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class HoroController extends Controller
{
    //
    public function horoshow(Request $request)
    {
        //ONLY FOR LOCATION
        $boy_location = $request->input('boy_place');
        $girl_location = $request->input('girl_place');

        

        
    
    
        // Retrieve the Geoapify API key from the configuration.  Make sure you have added this to your .env file
        $apiKey ='3eb3244f10b84c0592619d40ed22de7c';

        if (!$apiKey) {
            Log::error('Geoapify API key not configured.  Please add it to your .env file as GEOAPIFY_KEY=YOUR_API_KEY');
            dd('null'); // Or throw an exception, or return a more specific error response
        }

        //Getting location for boy...........
        try {
            // Make the HTTP request to the Geoapify Geocoding API.
            $response = Http::get('https://api.geoapify.com/v1/geocode/search', [
                'text' => $boy_location,
                'apiKey' => $apiKey,
                'format' => 'json', // Request JSON format.
            ]);

            // Check if the request was successful (status code 200).
            if ($response->successful()) {
                
                $data = $response->json();
                //return $data;

                // Check if any features were found in the response.
                if (isset($data)) {
                    
                    
                    // Extract the coordinates from the first feature.
                    //$coordinates = $data['results']['lon'];
                    $latitude2 = $data['results'][0]['lat']; // Latitude is the second element.
                    $longitude2 = $data['results'][0]['lon']; // Longitude is the first element.
                    

                   
                } else {
                    Log::warning('No features found for location: ' . $boy_location);
                    return null; // Or return a specific error value
                }
            } else {
                // Log the error with the response status and body for debugging.
                Log::error('Geoapify API request failed: ' . $response->status() . ' - ' . $response->body());
                return null; // Or throw an exception
            }
        } catch (\Exception $e) {
            // Catch any exceptions that might occur during the HTTP request.
            Log::error('Error during Geoapify API request: ' . $e->getMessage());
            return null; // Or throw an exception
        }

        // Getting location for girl..........

        try {
            // Make the HTTP request to the Geoapify Geocoding API.
            $response = Http::get('https://api.geoapify.com/v1/geocode/search', [
                'text' => $girl_location,
                'apiKey' => $apiKey,
                'format' => 'json', // Request JSON format.
            ]);

            // Check if the request was successful (status code 200).
            if ($response->successful()) {
                
                $data = $response->json();
                //return $data;

                // Check if any features were found in the response.
                if (isset($data)) {
                    
                    
                    // Extract the coordinates from the first feature.
                    //$coordinates = $data['results']['lon'];
                    $latitude1 = $data['results'][0]['lat']; // Latitude is the second element.
                    $longitude1 = $data['results'][0]['lon']; // Longitude is the first element.
                    

                   
                } else {
                    Log::warning('No features found for location: ' . $boy_location);
                    return null; // Or return a specific error value
                }
            } else {
                // Log the error with the response status and body for debugging.
                Log::error('Geoapify API request failed: ' . $response->status() . ' - ' . $response->body());
                return null; // Or throw an exception
            }
        } catch (\Exception $e) {
            // Catch any exceptions that might occur during the HTTP request.
            Log::error('Error during Geoapify API request: ' . $e->getMessage());
            return null; // Or throw an exception
        }










// XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


        //names of both of them
        $boy_name= $request->input('boy_name');
        $girl_name= $request->input('girl_name');

        $boy_time= $request->input('boy_time');
        $girl_time= $request->input('girl_time');
        //for date
        $boy_dob= $request->input('boy_date');
        $girl_dob= $request->input('girl_date');

        //for time
        $boyTimeParts = explode(':', $boy_time);
        $girlTimeParts = explode(':', $girl_time);
        //for date
        $boyDateParts = explode('-', $boy_dob);
        $girlDateParts = explode('-', $girl_dob);

        //extracting time for boys
        $boyHour = intval(ltrim($boyTimeParts[0], '0'));   // Remove leading zero
        $boyMinute = intval(ltrim($boyTimeParts[1], '0'));

        //extracting time for girls
        $girlHour = intval(ltrim($girlTimeParts[0], '0'));   // Remove leading zero
        $girlMinute = intval(ltrim($girlTimeParts[1], '0'));

        //extracting date for boys

        $boyYear = intval($boyDateParts[0]);
        $boyMonth = intval(ltrim($boyDateParts[1], '0')); // Remove leading zero
        $boyDay = intval(ltrim($boyDateParts[2], '0'));

        //extracting date for girls

        $girlYear = intval($girlDateParts[0]);
        $girlMonth = intval(ltrim($girlDateParts[1], '0')); // Remove leading zero
        $girlDay = intval(ltrim($girlDateParts[2], '0'));

        //dd($boyYear, $boyMonth, $boyDay, $boyHour, $boyMinute);
        try {
            
            $response = Http::withHeaders([
                'x-api-key' => '6y6RkqsNXTaegpohkWPIZ2hnI3nczbU610JJCpWB',
                'Content-Type' => 'application/json',
            ])->post('https://json.freeastrologyapi.com/match-making/ashtakoot-score', [
                
                'female' => [
                    'date' => $girlDay,
                    'month' => $girlMonth,
                    'year' => $girlYear,
                    'hours' => $boyHour,
                    'minutes' => $boyMinute,
                    'seconds' => 0,
                    'latitude' => $latitude1,
                    'longitude' => $longitude1,
                    'timezone' => 5.5
                ],
                'male' => [
                    'date' => $boyDay,
                    'month' => $boyMonth,
                    'year' => $boyYear,
                    'hours' => $girlHour,
                    'minutes' => $girlMinute,
                    'seconds' => 0,
                    'latitude' => $latitude2,
                    'longitude' => $longitude2,
                    'timezone' => 5.5
                ],
                'config'=>['language'=>'en'],

                
                
            ]);
            

            if ($response->successful()) {
                //return response()->json($response->json());
                $horoscopeData = $response->json();
                return view('horo',['horoscopeData' => $horoscopeData, 'boy_name' => $boy_name, 'girl_name' => $girl_name]);
            }

            //return response()->json(['error' => 'API request failed'], 500);
            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        // return app()->call('App\Http\Controllers\MangalController@mangalshow', [
        //         'request' => "hi", // Pass the entire $request object
                
        //     ]);
    }
}
    

