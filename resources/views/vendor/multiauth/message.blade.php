
@if (session()->has('message'))
    <script>
        $.alert({
            theme: 'material',
            type: 'green',
            typeAnimated: true,
            title: 'Success!',
            content: '{{ session()->get('message') }}',
        });
    </script>
@endif

@if (session()->has('custom_error'))

    <script>
        $.alert({
            theme: 'material',
            type: 'red',
            typeAnimated: true,
            title: 'Error!!',
            content: '{{ session()->get('custom_error') }}',
        });
    </script>
@endif

@if ($errors->count() > 0)
    <script>
        $.alert({
            theme: 'material',
            type: 'red',
            typeAnimated: true,
            title: 'Error!!',
            content: ' @foreach ($errors->all() as $error) {{ $error }} <br> @endforeach',
        });
    </script>

@endif