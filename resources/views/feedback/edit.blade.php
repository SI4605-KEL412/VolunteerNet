@extends('layouts.app')

@section('title', 'Edit Feedback')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="text-center mb-4 text-primary font-weight-bold">Edit Feedback</h2>

            <!-- Form edit feedback -->
            <form action="{{ route('feedback.update', $feedback->id) }}" method="POST" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                @csrf
                @method('PUT') <!-- Metode PUT untuk update -->

                <div class="mb-4">
                    <label for="customer_name" class="form-label">Customer Name</label>
                    <input type="text" class="form-control shadow-sm" id="customer_name" name="customer_name" 
                           value="{{ old('customer_name', $feedback->customer_name) }}" required>
                    @error('customer_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control shadow-sm" id="email" name="email" 
                           value="{{ old('email', $feedback->email) }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="restaurant_name" class="form-label">Restaurant Name</label>
                    <input type="text" class="form-control shadow-sm" id="restaurant_name" name="restaurant_name" 
                           value="{{ old('restaurant_name', $feedback->restaurant_name) }}" required>
                    @error('restaurant_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="feedback" class="form-label">Feedback</label>
                    <textarea class="form-control shadow-sm" id="feedback" name="feedback" rows="5" required>{{ old('feedback', $feedback->feedback) }}</textarea>
                    @error('feedback')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-custom px-5 py-3 shadow-sm rounded-pill">Update Feedback</button>
                    <a href="{{ route('feedback.index') }}" class="btn btn-secondary px-5 py-3 shadow-sm rounded-pill">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Form Styling */
    .php-email-form {
        padding: 40px;
        background-color: #f1f6fc;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .php-email-form:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .php-email-form .form-control {
        border-radius: 12px;
        box-shadow: none;
        font-size: 16px;
        padding: 12px 20px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .php-email-form .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
    }

    /* Button Styling */
    .php-email-form button[type="submit"],
    .php-email-form a {
        font-size: 18px;
        padding: 12px 40px;
        border-radius: 30px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .php-email-form button[type="submit"]:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: translateY(-2px);
    }

    .php-email-form a:hover {
        background-color: #6c757d;
        color: white;
        transform: translateY(-2px);
    }

    .text-danger {
        font-size: 12px;
        margin-top: 5px;
    }

    /* Mobile responsiveness */
    @media (max-width: 767px) {
        .php-email-form {
            padding: 25px;
        }

        .php-email-form button[type="submit"],
        .php-email-form a {
            padding: 10px 30px;
        }
    }

    /* Button Custom */
    .btn-custom {
        background-color: #ffcc00;
        color: #fff;
        border-radius: 30px;
        padding: 12px 36px;
        font-size: 1.1rem;
        font-weight: 600;
        transition: background-color 0.3s ease;
        border: none;
    }

    .btn-custom:hover {
        background-color: #e5b800;
        transform: translateY(-3px);
    }

    /* Improved input and button styling */
    .form-control {
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .btn {
        border-radius: 30px;
        font-weight: bold;
    }

    /* Shadow on focus */
    .form-control:focus {
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
    }
</style>
@endsection