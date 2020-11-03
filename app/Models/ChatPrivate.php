<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ChatPrivate extends Model
{
    use HasFactory;
    protected $table = 'chat_private';
    public function user()
	{
	  return $this->belongsTo(User::class);
	}
}
