<div class="error">
    <p>{{ $message }}</p>
</div>
@push('css')
    <style>
        .error {
            padding: 0.5em 1em;
            color: #df1313;
            background: #e4c6c6;
            border-left: solid 10px #df1313;
        }

        .error p {
            margin: 0;
            padding: 0;
        }
    </style>
@endpush
