<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Organizer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'organizers';

    protected $hidden = ['id', 'json_data', 'created_at', 'updated_at'];

}
