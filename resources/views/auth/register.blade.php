@extends('partial.main')

@section('body')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <!-- Card Utama -->
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>{{ __('Buat Akun Baru') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Kolom Form Register -->
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <!-- Name -->
                                    <div class="mb-3">
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>

                                    <!-- Email Address -->
                                    <div class="mb-3">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-3">
                                        <x-input-label for="password" :value="__('Password')" />
                                        <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="mb-3">
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                        <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <!-- Register Button -->
                                    <div class="d-flex justify-content-between">
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                            {{ __('Already registered?') }}
                                        </a>
                                        <x-primary-button class="btn btn-primary ms-3">
                                            {{ __('Register') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>

                            <!-- Kolom Logo dan Informasi ODF -->
                            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center bg-light p-4">
                                <!-- Logo Perusahaan -->
                                <div class="text-center mb-4">
                                    <img src="{{ asset('assets/image/logo_PKN.png') }}" alt="Logo Perusahaan" class="img-fluid" style="max-width: 150px;">
                                </div>

                                <!-- Pengertian ODF -->
                                <div class="text-center">
                                    <h5>Pengertian ODF</h5>
                                    <p>
                                        ODF (Open Defecation Free) adalah suatu kondisi di mana masyarakat tidak lagi melakukan
                                        buang air besar sembarangan. Dengan mencapai ODF, kita berkontribusi untuk kesehatan
                                        lingkungan dan masyarakat.
                                    </p>
                                </div>

                                <!-- Logo Mitra -->
                                <div class="text-center mt-3">
                                    <h6>Mitra Kami:</h6>
                                    <div class="d-flex justify-content-center">
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
    </div>
@endsection
