<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .btn-kembali {
            background-color: #0d47a1;
            color: white;
            border-radius: 12px;
            padding: 10px 20px;
            font-size: 1rem;
            text-decoration: none;
        }
        .btn-kembali:hover {
            background-color: #093170;
            color: white;
        }
        .form-label {
            font-weight: 600;
            color: #333;
        }
        .star-rating {
            color: #ffc107;
            font-size: 1.4rem;
        }
    </style>
</head>
<body>
    @include('feedback.navbar')

    <div class="container" style="max-width: 600px;">
        <div class="card p-4 mt-4">
            <h3 class="mb-4 text-primary">Detail Feedback</h3>

            <div class="mb-3">
                <label class="form-label">Nama Volunteer</label>
                <p>{{ $feedback->user->name ?? 'Tidak diketahui' }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Event</label>
                <p>{{ $feedback->event->title ?? 'Tidak diketahui' }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Rating</label>
                <p class="star-rating">
                    @php
                        $rating = $feedback->rating;
                        $fullStars = floor($rating);
                        $halfStar = ($rating - $fullStars) >= 0.5 ? true : false;
                        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                    @endphp

                    @for ($i = 0; $i < $fullStars; $i++)
                        <i class="fas fa-star"></i>
                    @endfor

                    @if ($halfStar)
                        <i class="fas fa-star-half-alt"></i>
                    @endif

                    @for ($i = 0; $i < $emptyStars; $i++)
                        <i class="far fa-star"></i>
                    @endfor
                </p>
            </div>

            <div class="mb-3">
                <label class="form-label">Komentar</label>
                <p>{{ $feedback->comments ?: '-' }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Diberikan</label>
                <p>{{ \Carbon\Carbon::parse($feedback->date_given)->format('d M Y, H:i') }}</p>
            </div>

            <a href="{{ route('feedback.index') }}" class="btn btn-kembali mt-3">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar Feedback
            </a>
        </div>
    </div>
</body>
</html>