<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Event & Sertifikat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to bottom, #0066cc, #f0f8ff);
            color: #003366;
            padding: 2rem;
        }
        h2 {
            margin-bottom: 2rem;
        }
        table thead {
            background-color: #004080;
            color: white;
        }
        .badge-sudah {
            background-color: #198754; /* warna hijau Bootstrap success */
        }
        .badge-belum {
            background-color: #6c757d; /* warna abu secondary */
        }
        a.btn-generate {
            background-color: #004080;
            color: white;
        }
        a.btn-generate:hover {
            background-color: #003366;
            color: white;
        }
        button.btn-disabled {
            pointer-events: none;
            opacity: 0.6;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="text-center">Daftar Event dan Sertifikat</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-striped table-bordered shadow-sm bg-white">
            <thead>
                <tr>
                    <th>Judul Event</th>
                    <th>Tanggal Event</th>
                    <th>Status Sertifikat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    @php
                        $cert = $certifications->firstWhere('event_id', $event->event_id);
                    @endphp
                    <tr>
                        <td>{{ $event->title }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                        <td>
                            @if ($cert)
                                <span class="badge badge-sudah">Sudah Digenerate</span>
                            @else
                                <span class="badge badge-belum">Belum Digenerate</span>
                            @endif
                        </td>
                        <td>
                            @if ($cert)
                                <button class="btn btn-outline-success btn-sm btn-disabled">Lihat Sertifikat</button>
                            @else
                                <a href="{{ route('certifications.generate', $event->event_id) }}" class="btn btn-generate btn-sm">Generate Sertifikat</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="{{ route('certifications.index') }}" class="btn btn-secondary">Kembali ke Halaman Sertifikat</a>
        </div>
    </div>

</body>
</html>
