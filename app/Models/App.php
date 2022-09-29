<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'apps';
    protected $fillable = ['id', 'app_name', 'category_id', 'created_at', 'updateda_at'];

    


}
