<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Supporter;
use App\Models\Settings;

class SupporterController extends Controller
{

    public function retrieveFrontend() {
        $settings = Settings::first();

        if($settings === null) {
            app('App\Http\Controllers\SettingsController')->createFirst();
        }

        $supporters = Supporter::orderBy('sort_order', 'asc')->limit($settings->supporters_shown)->get();

        return $supporters;
    }

    //
    /**
     * Display all
     */
    public function index() {
        $supporters = Supporter::orderBy('sort_order', 'asc')->get();

        return view('supporters_all')->with('supporters', $supporters);
    }

    /**
     * Show form for creating
     */
    public function create() {
        return view('supporters_create');
    }

    /**
     * Store newly created resource
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'details' => 'required'
        ]);

        $supporter = new Supporter([
            'name' => $request->get('name'),
            'details' => $request->get('details'),
            'sort_order' => $this->getMaxSortOrder()
        ]);
        $supporter->save();
        return redirect('/supporters')->with('success', 'Supporter saved!');
    }


    public function moveUp($id) {
        $supporter = Supporter::where('id', $id)->first();
        if($supporter === null) {
            return redirect('/supporters')->with('error', 'Entity not found!');
        }
        //Cant move any further up
        if($supporter->sort_order === 1) {
            return $this->index();
        }

        //Get the one above, as just need to change places
        $other = Supporter::where('sort_order', $supporter->sort_order-1)->first();

        $other->sort_order = $supporter->sort_order;
        $other->save();

        $supporter->sort_order -= 1;
        $supporter->save();

        return $this->index();

    }

    public function moveDown($id) {
        $supporter = Supporter::where('id', $id)->first();
        if($supporter === null) {
            return redirect('/supporters')->with('error', 'Entity not found!');
        }
        //Cant move any further down
        if($supporter->sort_order === $this->getMaxSortOrder()-1) {
            return $this->index();
        }

        //Get the one below, as just need to change places
        $other = Supporter::where('sort_order', $supporter->sort_order+1)->first();

        $other->sort_order = $supporter->sort_order;
        $other->save();

        $supporter->sort_order += 1;
        $supporter->save();

        return $this->index();
    }

    /**
     * Display resource
     */

    public function show($id) {
        
    }

    /**
     * Show edit form
     */
    public function edit($id) {
        $supporter = Supporter::find($id);
        return view('supporters_edit')->with('supporter', $supporter);
    }

    /**
     * Update specified resource
     */
    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'details' => 'required'
        ]);

        $supporter = Supporter::find($id);
        $supporter->name = $request->get('name');
        $supporter->details = $request->get('details');
        $supporter->save();

        return redirect('/supporters')->with('success', 'Supporter updated!');
    }

    /**
     * Delete resource
     */
    public function destroy($id) {
        $supporter = Supporter::find($id);
        $supporter->delete();

        return redirect('/supporters')->with('success', 'Supporter deleted!');
    }


    public function getMaxSortOrder() {
        return Supporter::max('sort_order')+1;
    }
}
