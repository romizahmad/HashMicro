<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function showForm()
    {
        return view('pages.compare.form');
    }

    public function compareInputs(Request $request)
    {
        $first = $request->first;
        $second = $request->second;

        $first = strtolower($first);
        $second = strtolower($second);

        $matchingCharactersCount = 0;

        foreach (str_split($first) as $char) {
            if (strpos($second, $char) !== false) {
                $matchingCharactersCount++;
            }
        }

        $percentage = ($matchingCharactersCount / strlen($first)) * 100;

        return view('pages.compare.form', ['result' => round($percentage, 2)]);
    }
}
