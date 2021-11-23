@extends('layouts.base')
@section('content')
     <!-- Session Status -->
     <x-auth-session-status class="mb-4" :status="session('status')" />

     <!-- Validation Errors -->
     <x-auth-validation-errors class="mb-4" :errors="$errors" />

     <div class="container my-5">
         <div class="col-lg-5 mx-auto py-5">
             <div class="card border-0 shadow-sm">
                 <div class="card-body">
                     <h4 class="card-title text-center">Welcome Back!</h4>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autofocus />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-label for="password" :value="__('Password')" />

                            <x-input id="password" class="block mt-1 w-full form-control"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                        <a href="{{ route('login') }}" class="text-decoration-none float-end text-secondary">I'm new</a>
                        <div class="flex items-center justify-end mt-4">
                            @if (Route::has('password.request'))
                                <a class="underline text-sm text-muted text-decoration-none text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif

                            <x-button class="ml-3 d-flex ms-auto btn btn-dark">
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </form>
                 </div>
             </div>
         </div>
     </div>
@endsection
