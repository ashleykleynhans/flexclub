<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Venue extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'venues';

    protected $hidden = ['json_data'];

}
