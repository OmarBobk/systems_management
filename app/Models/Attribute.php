<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Attribute extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return MorphTo
     */
    public function attributeable(): MorphTo
    {
        return $this->morphTo();
    }

}
