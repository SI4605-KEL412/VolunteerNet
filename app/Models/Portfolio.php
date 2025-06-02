<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolio';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'date',
        'location',
        'file_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function likesCount()
    {
        $count = 0;
        $users = User::all();

        foreach ($users as $user) {
            if ($user->profiledetails) {
                $profileDetails = json_decode($user->profiledetails, true);
                if (isset($profileDetails['liked_portfolios']) && in_array($this->id, $profileDetails['liked_portfolios'])) {
                    $count++;
                }
            }
        }

        return $count;
    }

    /**
     * Mengecek apakah portfolio ini dilike oleh user tertentu
     */
      public function likes()
    {
        return $this->belongsToMany(User::class, 'user_portfolio_likes')
            ->withTimestamps();
    }

}


