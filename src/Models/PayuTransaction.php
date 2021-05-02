<?php


namespace Gamespecu\LaravelPayu\Models;



use Illuminate\Database\Eloquent\Model;

class PayuTransaction extends Model
{
    protected $guarded = [];


    public function getTranslatedStatusAttribute()
    {
        return __('payu.' . $this->status);
    }
}
