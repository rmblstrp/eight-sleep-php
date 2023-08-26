<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use EightSleep\App\User\Objects\UserInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements UserInterface
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    function persist(): void
    {
        $this->save();
    }

    function getId(): int
    {
       return $this->getAttributeValue('id');
    }

    function getName(): string
    {
        return $this->getAttributeValue('name');
    }

    function setName(string $name): UserInterface
    {
        $this->setAttribute('name', $name);
        return $this;
    }

    function getEmail(): string
    {
        return $this->getAttributeValue('email');
    }

    function setEmail(string $email): UserInterface
    {
        $this->setAttribute('email', $email);
        return $this;
    }

    function getPassword(): string
    {
        return $this->getAttributeValue('password');
    }

    function setPassword(string $password): UserInterface
    {
        $this->setAttribute('password', $password);
        return $this;
    }
}
