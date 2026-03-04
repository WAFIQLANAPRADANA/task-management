<!DOCTYPE html>
<html>

<head>
    <title>Task Management</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind -->
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* ===============================
   BASE
=================================*/

        body {
            background: #f8fafc;
            color: #0f172a;
            transition: background 0.3s ease, color 0.3s ease;
        }

        /* Dark Mode Base */
        .dark body {
            background: #0f172a;
            color: #e2e8f0;
        }

        /* ===============================
   TYPOGRAPHY
=================================*/

        .dark h1,
        .dark h2,
        .dark h3,
        .dark h4,
        .dark h5,
        .dark h6,
        .dark strong {
            color: #f1f5f9;
        }

        .dark small {
            color: #94a3b8;
        }

        /* ===============================
   CARD
=================================*/

        .card {
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .dark .card {
            background: #1e293b !important;
            border: 1px solid #334155;
        }

        /* ===============================
   TABLE HEADER DARK FIX
=================================*/

        .dark .table thead,
        .dark .table thead tr,
        .dark .table thead th {
            background-color: #1e293b !important;
            color: #94a3b8 !important;
        }

        .dark .table {
            --bs-table-bg: transparent;
            --bs-table-hover-bg: #1e293b;
            --bs-table-border-color: #334155;
        }

        /* ==================================
   DATE INPUT ONLY
================================== */

        /* Light mode */
        input[type="date"] {
            background-color: #ffffff;
            color: #0f172a;
        }

        /* Dark mode */
        .dark input[type="date"] {
            background-color: #0f172a;
            border-color: #334155;
            color: #94a3b8;
        }

        /* Icon calendar dark mode */
        .dark input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1) brightness(1.2);
            opacity: 0.8;
        }

        /* Placeholder-style text (untuk browser tertentu) */
        .dark input[type="date"]::-webkit-datetime-edit {
            color: #94a3b8;
        }

        /* ===============================
   TABLE
=================================*/

        .dark .table {
            --bs-table-bg: transparent;
            --bs-table-striped-bg: transparent;
            --bs-table-hover-bg: #1e293b;
            --bs-table-border-color: #334155;
            color: #e2e8f0 !important;
            background-color: transparent !important;
        }

        .dark .table thead {
            --bs-table-bg: #1e293b;
        }

        .dark .table tbody {
            --bs-table-bg: transparent;
        }

        .dark .table td,
        .dark .table th {
            background-color: transparent !important;
        }

        /* ===============================
   FORM
=================================*/

        .form-control {
            border-color: #e2e8f0;
        }

        .dark .form-control {
            background: #0f172a;
            border-color: #334155;
            color: #f1f5f9;
        }

        .dark .form-control::placeholder {
            color: #64748b;
        }

        .dark .form-control:focus {
            border-color: #64748b;
            box-shadow: none;
        }

        /* ===============================
   BUTTON FIX
=================================*/

        .dark .btn {
            color: #e2e8f0;
        }

        /* ===============================
   DATE BADGE FIX
=================================*/

        .dark .bg-slate-900 {
            background: #334155 !important;
        }

        /* ===============================
   SCROLLABLE TABLE BODY ONLY
================================= */

        /* .table-scroll {
    max-height: 420px;
    overflow-y: auto;
} */

        .table-scroll {
            max-height: calc(100vh - 420px);
            overflow-y: auto;
        }

        /* Sticky header */
        .table-scroll thead th {
            position: sticky;
            top: 0;
            z-index: 5;
            background: #f8fafc;
        }

        /* Dark mode sticky header */
        .dark .table-scroll thead th {
            background: #1e293b;
        }

        /* Optional: smooth modern scrollbar */
        .table-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .table-scroll::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .dark .table-scroll::-webkit-scrollbar-thumb {
            background: #475569;
        }
    </style>
</head>

<body>

    <div class="container py-4 py-md-5">

        <!-- HEADER -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
            <div>
                <h3 class="fw-bold mb-0 text-slate-800 dark:text-slate-100">TechFiqs Task Management</h3>
                <small class="text-slate-500 dark:text-slate-400">
                    Kelola pekerjaan secara profesional
                </small>
            </div>

            <div class="d-flex align-items-center gap-2">
                <button onclick="toggleDark()"
                    class="btn btn-sm bg-slate-900 text-white rounded-xl px-3 dark:bg-slate-700">
                    <i class="bi bi-moon-stars"></i>
                </button>

                <span class="px-4 py-2 rounded-full bg-slate-900 text-white text-sm shadow-sm dark:bg-slate-700">
                    {{ now()->format('d M Y') }}
                </span>
            </div>
        </div>

        <!-- STATISTIK -->
        @php
            $antrian = $tasks->where('status', 'antrian')->count();
            $dikerjakan = $tasks->where('status', 'dikerjakan')->count();
            $pending = $tasks->where('status', 'pending')->count();
            $selesai = $tasks->where('status', 'selesai')->count();
        @endphp

        <div class="row mb-4">

            <div class="col-6 col-md-3 mb-3">
                <div class="card shadow-soft p-4 bg-white dark:bg-slate-800 relative overflow-hidden hover:shadow-md">
                    <div class="absolute top-0 left-0 h-full w-1 bg-slate-500"></div>
                    <h6 class="text-slate-500 dark:text-slate-400 text-sm mb-1">Antrian</h6>
                    <h3 class="text-slate-900 dark:text-white text-2xl font-semibold">{{ $antrian }}</h3>
                </div>
            </div>

            <div class="col-6 col-md-3 mb-3">
                <div class="card shadow-soft p-4 bg-white dark:bg-slate-800 relative overflow-hidden hover:shadow-md">
                    <div class="absolute top-0 left-0 h-full w-1 bg-blue-600"></div>
                    <h6 class="text-slate-500 dark:text-slate-400 text-sm mb-1">Dikerjakan</h6>
                    <h3 class="text-slate-900 dark:text-white text-2xl font-semibold">{{ $dikerjakan }}</h3>
                </div>
            </div>

            <div class="col-6 col-md-3 mb-3">
                <div class="card shadow-soft p-4 bg-white dark:bg-slate-800 relative overflow-hidden hover:shadow-md">
                    <div class="absolute top-0 left-0 h-full w-1 bg-amber-500"></div>
                    <h6 class="text-slate-500 dark:text-slate-400 text-sm mb-1">Pending</h6>
                    <h3 class="text-slate-900 dark:text-white text-2xl font-semibold">{{ $pending }}</h3>
                </div>
            </div>

            <div class="col-6 col-md-3 mb-3">
                <div class="card shadow-soft p-4 bg-white dark:bg-slate-800 relative overflow-hidden hover:shadow-md">
                    <div class="absolute top-0 left-0 h-full w-1 bg-emerald-600"></div>
                    <h6 class="text-slate-500 dark:text-slate-400 text-sm mb-1">Selesai</h6>
                    <h3 class="text-slate-900 dark:text-white text-2xl font-semibold">{{ $selesai }}</h3>
                </div>
            </div>

        </div>

        <!-- FORM -->
<div class="card shadow-soft mb-4 p-4 bg-white dark:bg-slate-800">

    <div class="row g-3 align-items-end">

        <!-- FORM TAMBAH TASK -->
        <div class="col-12 col-lg-9">
            <form action="/store" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <input type="text" name="title" class="form-control rounded-xl"
                            placeholder="Judul Task" required>
                    </div>

                    <div class="col-12 col-md-4">
                        <input type="text" name="description" class="form-control rounded-xl"
                            placeholder="Deskripsi">
                    </div>

                    <div class="col-12 col-md-3">
                        <input type="date" name="tanggal_mulai"
                            class="form-control rounded-xl" required>
                    </div>

                    <div class="col-12 col-md-1">
                        <button class="btn w-100 bg-slate-900 text-white rounded-xl">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- FORM EXPORT PDF (TERPISAH) -->
        <div class="col-12 col-lg-3">
            <form action="{{ route('tasks.export.pdf') }}" method="GET">
                <div class="d-flex gap-2">
                    <input type="month" name="month"
                        class="form-control form-control-sm rounded-xl"
                        required
                        value="{{ request('month') ?? now()->format('Y-m') }}">

<button type="submit"
    class="btn btn-dark btn-sm rounded-xl">
    <i class="bi bi-file-earmark-pdf-fill"></i>
</button>
                </div>
            </form>
        </div>

    </div>

</div>

        <!-- DESKTOP TABLE -->
        <div class="card shadow-soft bg-white dark:bg-slate-800">
            <div class="table-scroll table-responsive">
                <table class="table align-middle mb-0 text-sm">
                    <thead class="bg-slate-50 dark:bg-slate-800 text-slate-500 dark:text-slate-400 text-xs uppercase">
                        <tr>
                            <th>Task</th>
                            <th>Status</th>
                            <th width="80" class="text-center">Info</th>
                            <th width="180">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800 transition">
                                <td>
                                    <strong class="text-slate-800 dark:text-slate-100">{{ $task->title }}</strong><br>
                                    <small class="text-slate-500 dark:text-slate-400">{{ $task->description }}</small>
                                </td>

                                <td>
                                    @include('partials.status-badge', ['status' => $task->status])
                                </td>

                                <td class="text-center">
                                    <button
                                        class="btn btn-sm p-1 border border-slate-200 dark:border-slate-600 
               text-slate-600 dark:text-slate-300 rounded-lg"
                                        data-bs-toggle="tooltip" data-bs-trigger="hover focus" data-bs-placement="top"
                                        title="Mulai: {{ \Carbon\Carbon::parse($task->tanggal_mulai)->format('d M Y') }} 
        || Selesai: {{ $task->tanggal_selesai ? \Carbon\Carbon::parse($task->tanggal_selesai)->format('d M Y') : '-' }}">
                                        <i class="bi bi-calendar3 text-sm"></i>
                                    </button>
                                </td>

                                <td>
                                    <div class="d-flex flex-wrap gap-2">

                                        <a href="/status/{{ $task->id }}/dikerjakan"
                                            class="btn btn-sm border border-slate-200 dark:border-slate-600 text-slate-600 dark:text-slate-300 hover:bg-slate-900 hover:text-white transition rounded-lg">
                                            <i class="bi bi-play-fill"></i>
                                        </a>

                                        <a href="/status/{{ $task->id }}/pending"
                                            class="btn btn-sm border border-slate-200 dark:border-slate-600 text-slate-600 dark:text-slate-300 hover:bg-slate-900 hover:text-white transition rounded-lg">
                                            <i class="bi bi-pause-fill"></i>
                                        </a>

                                        <a href="/status/{{ $task->id }}/selesai"
                                            class="btn btn-sm border border-slate-200 dark:border-slate-600 text-slate-600 dark:text-slate-300 hover:bg-slate-900 hover:text-white transition rounded-lg">
                                            <i class="bi bi-check-lg"></i>
                                        </a>

                                        <a href="/delete/{{ $task->id }}"
                                            class="btn btn-sm border border-red-200 text-red-600 hover:bg-red-600 hover:text-white transition rounded-lg">
                                            <i class="bi bi-trash"></i>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center p-4 text-slate-400">
                                    Belum ada task.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        function toggleDark() {
            document.documentElement.classList.toggle('dark');
            localStorage.theme =
                document.documentElement.classList.contains('dark') ? 'dark' : 'light';
        }

        if (localStorage.theme === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltipTriggerList.forEach(function(el) {
                new bootstrap.Tooltip(el);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
