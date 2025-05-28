<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Status Pendaftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h3 class="mb-4">Edit Status Pendaftar</h3>

    <form action="{{ route('eo.recruitments.updateStatus', $recruitment->recruitment_id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="accepted" {{ $recruitment->status == 'accepted' ? 'selected' : '' }}>Terima</option>
                <option value="rejected" {{ $recruitment->status == 'rejected' ? 'selected' : '' }}>Tolak</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="admin_notes" class="form-label">Catatan (opsional)</label>
            <input type="text" name="admin_notes" id="admin_notes" class="form-control" value="{{ $recruitment->admin_notes }}">
        </div>

        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>

</body>
</html>