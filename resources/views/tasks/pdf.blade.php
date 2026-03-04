<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Task List PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f5f5f5; }
        .status-antrian { color: #6b7280; font-weight: bold; }
        .status-dikerjakan { color: #2563eb; font-weight: bold; }
        .status-pending { color: #d97706; font-weight: bold; }
        .status-selesai { color: #16a34a; font-weight: bold; }
    </style>
</head>
<body>
<h2>Task Management - {{ $month ? \Carbon\Carbon::parse($month.'-01')->format('F Y') : now()->format('d M Y') }}</h2>    <table>
        <thead>
            <tr>
                <th>Task</th>
                <th>Status</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <td>{{ $task->title }}<br><small>{{ $task->description }}</small></td>
                <td class="status-{{ $task->status }}">{{ ucfirst($task->status) }}</td>
                <td>{{ \Carbon\Carbon::parse($task->tanggal_mulai)->format('d M Y') }}</td>
                <td>{{ $task->tanggal_selesai ? \Carbon\Carbon::parse($task->tanggal_selesai)->format('d M Y') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p>Total Tasks: {{ $tasks->count() }}</p>
</body>
</html>