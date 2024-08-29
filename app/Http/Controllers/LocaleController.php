<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    public function setLocale($lang) {
        if (in_array($lang, ['en', 'es', 'ch'])) {
            App::setLocale($lang);
            Session::put('locale', $lang);
        }

        return back();
    }
}
