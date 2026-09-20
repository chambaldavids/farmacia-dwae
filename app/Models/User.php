<?php

namespace App\Models;

// Nota: este ficheiro substitui o app/Models/User.php gerado por defeito pelo
// `laravel new` — apenas foram acrescentados o campo `role` e a relação com
// as vendas registadas pelo utilizador (vendedor).

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function vendas(): HasMany
    {
        return $this->hasMany(Venda::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
