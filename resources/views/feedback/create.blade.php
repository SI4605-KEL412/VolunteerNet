@extends('layouts.app')

@section('title', 'Submit Feedback')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="text-center mb-5 text-primary font-weight-bold">Submit Your Feedback</h2>

            <!-- Form untuk mengirim feedback -->
            <form action="{{ route('feedback.store') }}" method="POST" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                @csrf
                <div class="row gy-4">

                    <!-- Input nama customer -->
                    <div class="col-md-6">
                        <input type="text" name="customer_name" class="form-control" placeholder="Your Name" required="" value="{{ old('customer_name') }}">
                        @error('customer_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input email customer -->
                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" placeholder="Your Email" required="" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pilih jenis feedback -->
                    <div class="col-md-12">
                        <select name="feedback_type" class="form-control" required>
                            <option value="">Select Feedback Type</option>
                            <option value="event" {{ old('feedback_type') == 'event' ? 'selected' : '' }}>Event</option>
                            <option value="ceo" {{ old('feedback_type') == 'ceo' ? 'selected' : '' }}>CEO</option>
                        </select>
                        @error('feedback_type')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input nama event (hanya tampil jika feedback_type = event) -->
                    <div class="col-md-12" id="event_name_div" style="display: none;">
                        <input type="text" class="form-control" name="event_name" placeholder="Event Name" value="{{ old('event_name') }}">
                        @error('event_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input feedback dari customer -->
                    <div class="col-md-12">
                        <textarea class="form-control" name="feedback" rows="6" placeholder="Your Feedback" required="">{{ old('feedback') }}</textarea>
                        @error('feedback')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol kirim -->
                    <div class="col-md-12 text-center">
                        <div class="loading">Loading...</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your feedback has been sent. Thank you!</div>

                        <button type="submit" class="btn btn-primary btn-lg px-5 py-3">Send Feedback</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection

<script>
    // Menunggu DOM siap sebelum menjalankan skrip
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk menampilkan atau menyembunyikan field event_name
        function toggleEventNameField() {
            var eventNameDiv = document.getElementById('event_name_div');
            var feedbackType = document.querySelector('[name="feedback_type"]').value;
            if (feedbackType === 'event') {
                eventNameDiv.style.display = 'block';
            } else {
                eventNameDiv.style.display = 'none';
            }
        }

        // Menambahkan event listener untuk perubahan pada feedback_type
        var feedbackTypeSelect = document.querySelector('[name="feedback_type"]');
        feedbackTypeSelect.addEventListener('change', toggleEventNameField);

        // Memeriksa apakah feedback_type sudah memiliki nilai pada saat halaman pertama kali dimuat
        toggleEventNameField();
    });
</script>

@section('styles')
<style>
    /* Styling untuk formulir */
    .php-email-form {
        padding: 40px;
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 35px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .php-email-form:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 50px rgba(0, 0, 0, 0.15);
    }

    /* Styling untuk input dan textarea */
    .php-email-form .form-control {
        border-radius: 10px;
        box-shadow: none;
        font-size: 16px;
        margin-bottom: 18px;
        padding: 14px;
        border: 1px solid #ccc;
        transition: border-color 0.3s ease;
    }

    .php-email-form .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    /* Tombol kirim */
    .php-email-form button[type="submit"] {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
        font-size: 18px;
        padding: 15px 40px;
        border-radius: 50px;
        transition: background-color 0.3s, border-color 0.3s, transform 0.3s ease;
    }

    .php-email-form button[type="submit"]:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: translateY(-4px);
    }

    .loading,
    .sent-message,
    .error-message {
        display: none;
    }

    .text-danger {
        font-size: 14px;
    }

    /* Animasi untuk form */
    .php-email-form[data-aos="fade-up"] {
        opacity: 0;
        transform: translateY(50px);
        transition: opacity 1s, transform 1s;
    }

    .php-email-form[data-aos="fade-up"].aos-animate {
        opacity: 1;
        transform: translateY(0);
    }

    /* Responsif untuk perangkat kecil */
    @media (max-width: 767px) {
        .php-email-form {
            padding: 25px;
        }

        .php-email-form button[type="submit"] {
            padding: 14px 35px;
        }

        .form-control {
            font-size: 14px;
            padding: 12px;
        }
    }
</style>
@endsection
