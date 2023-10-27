<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
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
        'department',
        'position'
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


    // Relationship for expenses created by staff
    public function staffExpenses()
    {
        return $this->hasMany(Expense::class, 'staff_id');
    }

    // Relationship for expenses created by managers
    public function managerExpenses()
    {
        return $this->hasMany(Expense::class, 'manager_id');
    }

    public function submittedExpenses(){
        return $this->hasMany(Expense::class, 'staff_id'); 
    }

    //relationship

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function hod()
    {
        return $this->belongsTo(User::class, 'hod_id');
    }

    public function staff()
    {
        return $this->hasMany(User::class, 'manager_id');
    }

    public function managerOf()
    {
        return $this->hasMany(User::class, 'manager_id');
    }

    public function hodOf()
    {
        return $this->hasMany(User::class, 'hod_id');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'staff_id');
    }


    public function hodExpenses()
    {
        return $this->hasManyThrough(Expense::class, User::class, 'hod_id', 'staff_id');
    }




}
