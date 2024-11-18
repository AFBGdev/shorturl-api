<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
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
            $slug = strtolower(Str::random(8));
            $redirectUrl = url("/".$slug);

            $link = Link::create([
                'target_url' => $targetUrl,
                'slug' => $slug,
                'redirect_url' => $redirectUrl,
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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $linkFound = Link::all()->find($id);

            if (!$linkFound) {
                return response()->json([
                    "status" => "error",
                    "error" => [
                        "code" => "7a76780c-c337-4058-b74b-71dccff710fe",
                        "message" => "Link not found!."
                    ]
                    ], 404);
            }

            $linkFound->delete();

            $responseData = [
                'status' => "success",
                'data' => $id,
            ];

            return response()->json($responseData, 200);

        } catch (\Exception $error) {
            Log::error($error->getMessage());

            return response()->json([
                "status" => "error",
                "error" => [
                    "code" => "924c7046-dd08-48f1-8cd9-a17ebb744ded",
                    "message" => "Internal server error!."
                    ]
                ], 500);
        }
    }
}
