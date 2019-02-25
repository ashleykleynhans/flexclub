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

    protected $hidden = ['json_data'];

}
