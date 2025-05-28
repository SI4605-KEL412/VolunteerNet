<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Pendaftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h3 class="mb-4">Detail Pendaftaran Volunteer</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $recruitment->user->name }}</p>
            <p><strong>Email:</strong> {{ $recruitment->user->email }}</p>
            <p><strong>Event:</strong> {{ $recruitment->event->name }}</p>
            <p><strong>Motivasi:</strong> {{ $recruitment->motivation }}</p>
            <p><strong>Status:</strong> 
                <span class="badge bg-{{ 
                    $recruitment->status == 'accepted' ? 'success' : 
                    ($recruitment->status == 'rejected' ? 'danger' : 'secondary') 
                }}">{{ ucfirst($recruitment->status) }}</span>
            </p>
            <p><strong>Catatan EO:</strong> {{ $recruitment->admin_notes ?? '-' }}</p>
        </div>
    </div>
</div>

</body>
</html>