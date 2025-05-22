<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\ReferralProgram;

class ReferralController extends Controller
{
    public function index()
{
    $user = auth()->user();

    $referralCode = $user->referralcode;

    $referrals = ReferralProgram::with(['referrer', 'referredUser'])
        ->where('referrer_id', $user->user_id)
        ->get();

    return view('referral.index', [
        'referralCode' => $referralCode,
        'referrals' => $referrals,
    ]);
}


    public function generate()
{
    $user = auth()->user();

    if ($user->referralcode) {
        return redirect()->route('referral.index')->with('error', 'Anda sudah memiliki kode referral.');
    }

    // Generate kode referral baru
    $code = strtoupper(Str::random(8));

    // Simpan ke kolom referralcode user
    $user->referralcode = $code;
    $user->save();

    // Buat record referralprogram untuk kode referral ini
    ReferralProgram::create([
        'referrer_id' => $user->user_id,
        'referred_user_id' => null,  // Belum ada yang direfer
        'date_referred' => now(),
        'reward_earned' => null,
    ]);

    return redirect()->route('referral.index')->with('success', 'Kode referral berhasil dibuat!');
}

    /**
     * Simpan relasi referral, misal user baru daftar pakai kode referral
     * Request harus berisi: referred_user_id, referral_code
     */
    public function storeReferral(Request $request)
{
    $request->validate([
        'referral_code' => 'required|string|exists:users,referralcode'
    ]);

    $user = auth()->user();

    // Cek apakah sudah pernah direferensikan
    $alreadyReferred = ReferralProgram::where('referred_user_id', $user->user_id)->exists();
    if ($alreadyReferred) {
        return redirect()->route('referral.index')->with('error', 'Anda sudah menggunakan kode referral sebelumnya.');
    }

    // Cek apakah kode referral valid dan bukan milik sendiri
    $referrer = User::where('referralcode', $request->referral_code)->first();
    if (!$referrer || $referrer->user_id == $user->user_id) {
        return redirect()->route('referral.index')->with('error', 'Kode referral tidak valid atau milik sendiri.');
    }

    // Simpan referral
    ReferralProgram::create([
        'referrer_id' => $referrer->user_id,
        'referred_user_id' => $user->user_id,
        'date_referred' => now(),
        'reward_earned' => null,
    ]);

    // Tambahkan poin ke referrer
    $referrer->points += 10;
    $referrer->save();

    return redirect()->route('referral.index')->with('success', 'Kode referral berhasil digunakan!');
}


}
