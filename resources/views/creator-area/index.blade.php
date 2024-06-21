

@extends('master', [
    'pageTitle' => 'Creator Area',
    'bodyClass' => 'create-page',
    'gridFluid' => true
])

@section('content')
    @if (!settings('creator_area_enabled'))
        <div class="container construction-container">
            <i class="icon icon-sad construction-icon"></i>
            <div class="construction-text">Sorry, the Creator Area is unavailable right now for maintenance. Try again later.</div>
        </div>
    @else
    <div class="container create-container">
            <h3 class="create-title">What do you wish to create?</h3>
            <div class="push-25"></div>
            <div class="grid-x grid-margin-x">
                                    <div class="cell small-6 medium-4 create-cell">
                        <a href="/">
                            <div class="create-cell-title">T-Shirt</div>
                        </a>
                    </div>
                                    <div class="cell small-6 medium-4 create-cell">
                        <a href="https://bloxcity.co/creator-area/create/shirt">
                            <div class="create-cell-title">Shirt</div>
                        </a>
                    </div>
                                    <div class="cell small-6 medium-4 create-cell">
                        <a href="https://bloxcity.co/creator-area/create/pants">
                            <div class="create-cell-title">Pants</div>
                        </a>
                    </div>
                            </div>
        </div>
                        </div>
                </div>
            </div>
        </div>
		@endif
@endsection
