@if (Session::has(Constants::ACTION_ERROR))
    <div class="alert alert-danger mt-2" role="alert">
        {{ Session::get(Constants::ACTION_ERROR) }}
    </div>
@elseif (Session::has(Constants::ACTION_SUCCESS))
    <div class="alert alert-success mt-2" role="alert">
        {{ Session::get(Constants::ACTION_SUCCESS) }}
    </div>
@endif
