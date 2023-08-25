@extends('layouts.app')

@section('content')
    <section classname="snippet-body">
        <div class="container">
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card py-3 px-2">
                        <p class="text-center mb-3 mt-2">{{ __('Login With') }} </p>
                        <div class="row mx-auto ">
                            <div class="col-4">
                                <i class="fab fa-twitter"></i>
                            </div>
                            <div class="col-4">
                                <i class="fab fa-facebook"></i>
                            </div>
                            <div class="col-4">
                                <i class="fab fa-google"></i>
                            </div>
                        </div>
                        <div class="division">
                            <div class="row">
                                <div class="col-3">
                                    <div class="line l"></div>
                                </div>
                                <div class="col-6"><span>{{ __('OR WITH MY EMAIL') }}</span></div>
                                <div class="col-3">
                                    <div class="line r"></div>
                                </div>
                            </div>
                        </div>
                        <form class="myform" method="POST" action="{{route('auth.login.store')}} ">
                            @csrf
                            @include('components.field', [
                                'class' => 'col-md-12',
                                'type' => 'email',
                                'name' => 'email',
                                'placeholder' => 'Email/username',
                            ])
                            @include('components.field', [
                                'class' => 'col-md-12',
                                'type' => 'password',
                                'name' => 'password',
                                'placeholder' => 'Password',
                            ])

                            <div class="row">
                                <div class="col-md-6 col-12">

                                    @include('components.field', [
                                        'class' => 'form-group form-check',
                                        'type' => 'checkbox',
                                        'name' => 'remember',
                                        'placeholder' => 'Remember me',
                                    ])

                                </div>
                                <div class="col-md-6 col-12 bn">{{ __('Forgot my password') }}</div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-block btn-primary btn-lg"><small><i
                                            class="far fa-user pr-2"></i>{{ __('Login') }}</small></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
