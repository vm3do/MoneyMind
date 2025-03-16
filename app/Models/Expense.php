<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /** @use HasFactory<\Database\Factories\ExpenseFactory> */
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getNextAutopayAttribute(){
        if(!$this->is_recurring){
            return null;
        }

        $paid_on = $this->date;
        $next_autopay = Carbon::parse($paid_on);
        
        switch ($this->frequency) {
            case 'daily':
                $next_autopay->addDay();
                break;
            case 'monthly':
                $next_autopay->addMonth();
                break;
            case 'yearly':
                $next_autopay->addYear();
                break;
            
            default:
            return null;
        }

        return $next_autopay->format('m F');
    }
}
