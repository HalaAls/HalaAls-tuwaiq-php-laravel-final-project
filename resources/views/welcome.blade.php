@extends('layouts.app')
@section('content')

    <body style="background-image: url('/assets/images/background.png');">
        <!-- Your content here -->

        <div class="container text-center mb-5 ">
            <h1 class="albert-sans">{{ __('messages.Heading1') }}</h1>
            <p class="h5">{{ __('messages.Heading2') }}</p>
            <div class="row text-center d-flex justify-content-center mt-5">
                <div class="col-sm-3">
                    <div class="card mb-3" style="max-width: 18rem; background-color: #F4E24A; ">
                        <div class="card-header">{{ __('messages.Cases') }}</div>
                        <div class="card-body">
                            <div class="card-image"><img src="\assets\images\cases.png" alt="cases" style="width: 100px">
                            </div>
                            <a href="{{ route('listItembycat', ['cat' => 'Cases']) }}" class="btn btn-primary px-5 mt-5"
                                style="btn text-decoration:none;">{{ __('messages.ViewProducts') }}</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="card mb-3" style="max-width: 18rem; background-color: #76E1BA ; ">
                        <div class="card-header"> {{ __('messages.Challenges') }}</div>
                        <div class="card-body">
                            <div class="card-image"><img src="\assets\images\challenges.png" alt="Challenges"
                                    style="width: 100px">
                            </div>
                            <a href="{{ route('listItembycat', ['cat' => 'Challenges']) }}"
                                class="btn btn-primary px-5 mt-5"
                                style="btn text-decoration:none;">{{ __('messages.ViewProducts') }}</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="card mb-3" style="max-width: 18rem; background-color: #FFADB4; ">
                        <div class="card-header"> {{ __('messages.Questions') }}</div>
                        <div class="card-body">
                            <div class="card-image"><img src="\assets\images\questions.png" alt="Questions"
                                    style="width: 100px">
                            </div>
                            <a href="{{ route('listItembycat', ['cat' => 'Questions']) }}"
                                class="btn btn-primary px-5 mt-5"
                                style="btn text-decoration:none;">{{ __('messages.ViewProducts') }}</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </body>
@endsection
