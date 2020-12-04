<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class MemberNote extends Model
{
    use HasTrixRichText;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'member_notes';
    protected $guarded = ['id'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /**
     * Auto-save in trait HasTrixRichText not work, that's why added this custom method
     *
     * @param array $fieldsData
     */
    public function saveTrixRichText($fieldsData) {
        foreach ($fieldsData as $field => $content) {
            $this->trixRichText()->updateOrCreate([
                'field' => $field,
            ], [
                'field'   => $field,
                'content' => $content,
            ]);
        }
    }

    public function trixRender($field)
    {
        $trixRender = $this->trixRichText->where('field', $field)->first();

        return $trixRender ? $trixRender->content : null;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
