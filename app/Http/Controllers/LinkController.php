<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $links = Link::all();

            $responseData = [
                "status" => "success",
                "data" => $links
            ];

            return response()->json($responseData);

        } catch (\Exception $error) {
            Log::error($error->getMessage());

            return response()->json([
                "status" => "error",
                "error" => [
                    "code" => "b28e75a8-28f2-40c0-8627-ebf443831627",
                    "message" => "Internal server error!."
                    ]
                ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'target' => ['required'],
            ]);

            $targetUrl = filter_var($request->target, FILTER_SANITIZE_URL);
            $shortUrl = strtolower(Str::random(8));

            $link = Link::create([
                'target_url' => $targetUrl,
                'short_url' => $shortUrl,
            ]);

            $responseData = [
                'status' => "success",
                'data' => $link,
            ];

            return response()->json($responseData);

        } catch (\Exception $error) {
            Log::error($error->getMessage());

            return response()->json([
                "status" => "error",
                "error" => [
                    "code" => "8069ef56-d013-4fb5-bef0-8fef494aaeda",
                    "message" => "Internal server error!."
                    ]
                ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Link $link)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        //
    }
}
