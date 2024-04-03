<div class="alert alert-{{ $type ?? 'info ' }}">
    <h4>{{ $title }}</h4>
    {{ $slot }}
    {{-- $slot
        to show any view for the compnent
         --}}
</div>
