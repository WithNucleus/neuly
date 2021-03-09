<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class CompanySerpapiData extends Model
{
    use CrudTrait;

    protected $table = 'company_serpapi_data';
    protected $guarded = ['id'];
    protected $casts = ['knowledge_graph' => 'array'];

    public function scopeNotReviewed($query)
    {
        return $query->where('reviewed', 0);
    }

    public function scopeReviewed($query)
    {
        return $query->where('reviewed', 1);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
