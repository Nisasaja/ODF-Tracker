@extends('partial.main')

@section('body')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <!-- Card Utama -->
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="row no-gutters">
                        <!-- Bagian Kiri: Form Login -->
                        <div class="col-md-6 p-4">
                            <div class="card-body">
                                <div class="text-center mb-4">
                                    <h2 class="text-primary">{{ __('Masukkan Akun') }}</h2>
                                </div>

                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <!-- Email Address -->
                                    <div class="mb-3">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-3">
                                        <x-input-label for="password" :value="__('Password')" />
                                        <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Remember Me -->
                                    <div class="form-check mb-3">
                                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                        <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="d-flex justify-content-between">
                                        @if (Route::has('password.request'))
                                            <a class="text-sm text-primary" href="{{ route('password.request') }}">
                                                {{ __('Forgot your password?') }}
                                            </a>
                                        @endif

                                        <x-primary-button class="btn btn-primary ms-3">
                                            {{ __('Login') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Bagian Kanan: Logo dan Pengertian ODF -->
                        <div class="col-md-6 bg-light p-4 d-flex flex-column justify-content-center align-items-center">
                            <div class="text-center">
                                <img src="{{ asset('assets/image/ODF.png') }}" alt="Logo Perusahaan" class="img-fluid mb-3" style="max-width: 150px;">
                            </div>

                            <div class="text-center">
                                <h5>Apa Itu ODF ?</h5>
                                <p>
                                    ODF (Open Defecation Free) adalah suatu kondisi di mana masyarakat tidak lagi melakukan
                                    buang air besar sembarangan. Dengan mencapai ODF, kita berkontribusi untuk kesehatan
                                    lingkungan dan masyarakat.
                                </p>
                            </div>

                            <div class="text-center mt-3">
                                <h6>Mitra Kami:</h6>
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('assets/image/logo_PKN.png') }}" alt="Partner 1" class="img-fluid me-2" style="max-width: 60px;">
                                    <img src="{{ asset('assets/image/Bulungan.png') }}" alt="Partner 1" class="img-fluid me-2" style="max-width: 50px;">
                                    <img src="{{ asset('assets/image/Kesehatan.png') }}" alt="Partner 2" class="img-fluid me-2" style="max-width: 50px;">
                                    <img src="{{ asset('assets/image/YDBK.png') }}" alt="Partner 3" class="img-fluid me-2" style="max-width: 50px;">
                                    <img src="{{ asset('assets/image/ENM.png') }}" alt="Partner 4" class="img-fluid" style="max-width: 50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
