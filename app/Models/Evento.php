<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class Evento extends Model
{
    protected $fillable = ['title', 'description', 'data_inicio', 'data_fim', 'local', 'banner', 'slug'];

    public function inscrito()
    {
        return $this->hasMany(Inscrito::class);
    }

    public function countInscritos()
    {
        return count(DB::select("SELECT DISTINCT nome FROM inscritos WHERE evento_id = ?", [$this->id]));
    }
}
