<?php
namespace JewelRana\PasswordPolicy\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['password'];
}
