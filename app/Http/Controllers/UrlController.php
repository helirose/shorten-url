<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function encodeUrl(Request $request) : JsonResponse
    {
        $original_url = $request->query('url');

        // Return error if no url is provided
        if (!$original_url) {
            return response()->json(['error' => 'Invalid URL'], 400);
        }

        // try to fetch existing shorturl and return, if it doesn't exist generate new
        $shortcode = Url::where('original_url', $original_url)->first();
        if(!$shortcode) {
            
            $new_shortcode = Url::generateShortcode($original_url);
            $short_url = url("/decode/$new_shortcode");
            
            $url = Url::create([
                'original_url' => $original_url,
                'short_code' => $new_shortcode
            ]);

            $url->save();
        } else {
            $short_url = url("/decode/$shortcode->shortcode");
        }
        return response()->json([
            'url' => $original_url, 
            'shorturl' => $short_url
        ], 200, [], JSON_UNESCAPED_SLASHES);
    }

    public function decodeUrl(Request $request)
    {
        $url = Url::where('short_code', $request->shortcode)->first();
        if($url) {
            return response()->json([
                'url' => $url->original_url, 
                'shorturl' => url("/decode/$url->short_code")
            ], 200, [], JSON_UNESCAPED_SLASHES);

            // Alternate response type for a user friendly web application
            // return redirect()->away($original_url->original_url);
        } else {
            return response()->json(['message' => 'Short URL not found'], 404);
        }
    }
}
