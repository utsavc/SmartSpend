<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

     // Relationship to get the staff who created the expense
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    // Relationship to get the manager who approved the expense
    public function manager(){
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function submittedByUser(){
        return $this->belongsTo(User::class, 'staff_id'); 
    }

    // Expense.php

    public function user()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }


}
