<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'points',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $keyType = 'int';

    public function referralProgram()
    {
        return $this->hasOne(ReferralProgram::class, 'referrer_id', 'user_id');
    }

    public function certifications()
    {
        return $this->hasMany(Certification::class, 'user_id', 'user_id');
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class, 'user_id');
    }

    public function getLikedPortfolios()
    {
        if (!$this->profiledetails) {
            return [];
        }

        $profileDetails = json_decode($this->profiledetails, true);
        return $profileDetails['liked_portfolios'] ?? [];
    }

    public function likePortfolio($portfolioId)
    {
        $profileDetails = $this->profiledetails ? json_decode($this->profiledetails, true) : [];

        $profileDetails['liked_portfolios'] = $profileDetails['liked_portfolios'] ?? [];

        if (!in_array($portfolioId, $profileDetails['liked_portfolios'])) {
            $profileDetails['liked_portfolios'][] = $portfolioId;
            $this->profiledetails = json_encode($profileDetails);
            $this->save();
            return true;
        }

        return false;
    }

    public function unlikePortfolio($portfolioId)
    {
        if (!$this->profiledetails) {
            return false;
        }

        $profileDetails = json_decode($this->profiledetails, true);

        if (!isset($profileDetails['liked_portfolios'])) {
            return false;
        }

        $key = array_search($portfolioId, $profileDetails['liked_portfolios']);
        if ($key !== false) {
            unset($profileDetails['liked_portfolios'][$key]);
            $profileDetails['liked_portfolios'] = array_values($profileDetails['liked_portfolios']);
            $this->profiledetails = json_encode($profileDetails);
            $this->save();
            return true;
        }

        return false;
    }
    public function impacttracker()
    {
        return $this->hasMany(\App\Models\ImpactTracker::class, 'user_id', 'user_id');
    }
    public function recruitments()
    {
        return $this->hasMany(\App\Models\Recruitment::class, 'user_id', 'user_id');
    }

    // Relasi ke event yang diikuti user lewat recruitment
    public function events()
    {
        return $this->belongsToMany(
            Event::class,
            'recruitment',      // nama tabel pivot
            'user_id',          // foreign key di tabel recruitment
            'event_id',         // foreign key event di tabel recruitment
            'user_id',          // local key di tabel users
            'event_id'          // local key di tabel event
        )->withPivot('status', 'motivation', 'admin_notes', 'date_applied');
    }
}
