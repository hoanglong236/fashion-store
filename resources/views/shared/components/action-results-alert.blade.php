@if (Session::has(Constants::ACTION_ERROR))
    <script>
        alert('{{ Session::get(Constants::ACTION_ERROR) }}');
    </script>
@elseif (Session::has(Constants::ACTION_SUCCESS))
    <script>
        alert('{{ Session::get(Constants::ACTION_SUCCESS) }}');
    </script>
@endif
