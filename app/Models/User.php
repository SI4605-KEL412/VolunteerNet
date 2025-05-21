<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Menentukan kolom primary key yang digunakan
    protected $primaryKey = 'user_id';

    // Tentukan jika kamu tidak ingin menggunakan timestamps (optional)
    public $timestamps = true; // Ini default-nya, jadi bisa dibiarkan true

    // Menentukan kolom yang bisa diisi secara mass-assignment
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    // Menentukan kolom yang harus disembunyikan, seperti password dan token
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Jika kamu ingin mengubah tipe primary key (contoh: non-integer)
    protected $keyType = 'int';

    /**
     * Mendapatkan portfolio yang dilike oleh user
     */
    public function getLikedPortfolios()
    {
        if (!$this->profiledetails) {
            return [];
        }

        $profileDetails = json_decode($this->profiledetails, true);
        if (!isset($profileDetails['liked_portfolios'])) {
            return [];
        }

        return $profileDetails['liked_portfolios'];
    }

    /**
     * Menambahkan like ke portfolio
     */
    public function likePortfolio($portfolioId)
    {
        $profileDetails = $this->profiledetails ? json_decode($this->profiledetails, true) : [];

        if (!isset($profileDetails['liked_portfolios'])) {
            $profileDetails['liked_portfolios'] = [];
        }

        if (!in_array($portfolioId, $profileDetails['liked_portfolios'])) {
            $profileDetails['liked_portfolios'][] = $portfolioId;
            $this->profiledetails = json_encode($profileDetails);
            $this->save();
            return true;
        }

        return false;
    }

    /**
     * Menghapus like dari portfolio
     */
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


}




