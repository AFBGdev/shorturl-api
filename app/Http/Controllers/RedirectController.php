<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Support\Facades\Log;

class RedirectController extends Controller
{
    public function index(string $linkSlug)
    {
        try {
            if (!$linkSlug) return redirect('/');

            $linkFound = Link::where('short_url', $linkSlug)->first();

            $redirectLink = $linkFound->target_url;
            return redirect($redirectLink, 302);

        } catch (\Exception $error) {
            Log::error($error->getMessage());
        }
    }
}
