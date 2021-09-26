<?php
namespace JewelRana\PasswordPolicy\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPassword extends Model
{
    protected $fillable = ['user_id', 'password'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
