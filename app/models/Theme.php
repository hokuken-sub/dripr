<?php

class Theme extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'themes';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('user_id');

    /**
     * The validation rules for store
     *
     * @var array
     */
    protected $rules = array(
        ['title' => 'required|min:1'],
        ['template' => 'required'],
        ['parent_theme_key' => 'min:40'],
    );

}
