<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
		'email',
		'position',
		'address',
		'birthday'
    ];

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class)->withPivot('expertise');;
    }
}
