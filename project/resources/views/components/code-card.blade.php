<div class="card mt-3 bg-default">
    <div class="card-body">
        <p class="card-text text-{{$color}} text-lg">{{ $label }}</p>
        <div style="white-space: pre-wrap" class="card-text text-{{$color}} ql-font-monospace text-monospace">{!! $content ?? '' !!}</div>
    </div>
</div>
