@extends('layout')

@section('content')

<div class="row mt-5 mb-3">
    <div class="card text-center" style="padding: 0;max-width: 300px;margin: 0 auto;">
        <div class="card-header">
            <h5 class="text-uppercase mt-2">{{ __('Randomizer') }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Welcome to the game</h5>
            <p class="card-text text-secondary">Press the button below to play</p>
            <button type="button" class="btn btn-danger" id="imfeelinglucky">
                {{ __('Im feeling lucky') }}
                <div class="spinner-border spinner-border-sm ml-5 ms-1" style="display: none;" role="status"></div>
            </button>
            <div class="game-result mt-4"></div>
        </div>

        <div class="card-footer text-muted">
            <button class="btn btn-dark-outline" id="history">
                {{ __('History') }}
                <div class="spinner-border spinner-border-sm ml-5 ms-1" style="display: none;" role="status"></div>
            </button>
            <ul class="history-list-group list-group mt-1">
            </ul>
        </div>
    </div>
    <div class="col-12 mt-2 text-center">
        <x-form action="{{ route('regenerate-url') }}" method="patch">
            <input type="hidden" name="url" value="{{ request('url') }}">
            <button class="btn btn-link text-secondary" type="submit">
                {{ __('Regenerate url') }}
            </button>
        </x-form>
    </div>
    <div class="col-12 mt-2 text-center">
        <x-form action="{{ route('deactivate-url') }}" method="patch">
            <input type="hidden" name="url" value="{{ request('url') }}">
            <button class="btn btn-link text-secondary" type="submit">
                {{ __('Deactivate url') }}
            </button>
        </x-form>
    </div>
</div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>
@endsection
