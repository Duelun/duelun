<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Settings;

class SettingsController extends Controller
{
    //

    public function index() {
        $settings = Settings::first();

        if($settings === null) {
            $settings = $this->createFirst();
        }

        return view('settings')->with('settings', $settings);
    }

    public function createFirst() {
        return Settings::create([
            'latest_shown' => 5,
            'supporters_shown' => 5
        ]);
    }

    public function save(Request $request) {
        $validatedData = $request->validate([
            'latest_shown' => 'integer',
            'supporters_shown' => 'integer'
        ]);

        $settings = Settings::first();

        $settings->fill($validatedData);
        $settings->save();

        return redirect('/settings')->with('success', 'Changes saved.');
    }
}
