@php
    $base = "inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium";

    switch($status){
        case 'antrian':
            $class = "bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300";
            $icon = "bi-hourglass-split";
            break;

        case 'dikerjakan':
            $class = "bg-blue-100 text-blue-600 dark:bg-blue-900/40 dark:text-blue-300";
            $icon = "bi-play-fill";
            break;

        case 'pending':
            $class = "bg-amber-100 text-amber-600 dark:bg-amber-900/40 dark:text-amber-300";
            $icon = "bi-pause-fill";
            break;

        case 'selesai':
            $class = "bg-emerald-100 text-emerald-600 dark:bg-emerald-900/40 dark:text-emerald-300";
            $icon = "bi-check-lg";
            break;

        default:
            $class = "bg-gray-200 text-gray-600";
            $icon = "bi-question";
    }
@endphp

<span class="{{ $base }} {{ $class }}">
    <i class="bi {{ $icon }}"></i>
    {{ ucfirst($status) }}
</span>