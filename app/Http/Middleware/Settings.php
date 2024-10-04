<?php

namespace App\Http\Middleware;

use App\Models\City;
use App\Models\Setting;
use Closure;

class Settings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $favicon = Setting::where('name', 'favicon')->value('val');
        $logo = Setting::where('name', 'logo')->value('val');
        $logo_secondary = Setting::where('name', 'logo_secondary')->value('val');
        $logo_third = Setting::where('name', 'logo_third')->value('val');
        $watermark = Setting::where('name', 'watermark')->value('val');
        $banner_default = Setting::where('name', 'banner_default')->value('val');

        $app_name = Setting::where('name', 'app_name')->value('val');
        $subtitle = Setting::where('name', 'subtitle')->value('val');
        $api_google_maps = Setting::where('name', 'google_map_api_key')->value('val');

        view()->share('favicon', $favicon);
        view()->share('logo', $logo);
        view()->share('logo_secondary', $logo_secondary);
        view()->share('logo_third', $logo_third);
        view()->share('watermark', $watermark);
        view()->share('banner_default', $banner_default);

        view()->share('app_name', $app_name);
        view()->share('subtitle', $subtitle);

        view()->share('api_google_maps', $api_google_maps);




        return $next($request);
    }
}
