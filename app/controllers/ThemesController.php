<?php

class ThemesController extends \BaseController {

    /**
     * Display a listing of themes
     *
     * @return Response
     */
    public function index()
    {
        $themes = Theme::all();

        return View::make('themes.index', compact('themes'));
    }

    /**
     * Show the form for creating a new theme
     *
     * @return Response
     */
    public function create()
    {
        return View::make('themes.create');
    }

    /**
     * Store a newly created theme in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make($data = Input::all(), Theme::$rules);

        if ($validator->fails())
        {
            dd($validator);
            return Response::json([
                    'error' => true,
                    'message' => 'cannot store the data',
                    'data' => $data,
                    'errors' => $validator
                ]);
        }
        
        $theme = new Theme($data);
        

//        Theme::create($data);

        return Response::json([
            'error' => false,
            'message' => 'Successfully Saved!',
            200
        ]);
    }

    /**
     * Display the specified theme.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try
        {
            $theme = Theme::findOrFail($id);
        }
        catch (Illuminate\Database\Eloquent\ModelNotFoundException $e)
        {
            return Response::json([
                    'error' => true,
                    'message' => 'Specified Theme (ID: '. e($id) .') is not Found',
                    404
                ]);
        }

        return Response::json([
                'error' => false,
                'theme' => $theme->toArray(),
                200
            ]);
    }

    /**
     * Show the form for editing the specified theme.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $theme = Theme::find($id);

        return View::make('themes.edit', compact('theme'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $theme = Theme::findOrFail($id);

        $validator = Validator::make($data = Input::all(), Theme::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $theme->update($data);

        return Redirect::route('themes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Theme::destroy($id);

        return Redirect::route('themes.index');
    }

}