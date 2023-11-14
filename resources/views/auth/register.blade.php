@extends('layouts.master')
@section('title')
    REGISTER
@endsection


@section('content')

    <div class="flex-1 max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl my-5">
        <div class="flex flex-col overflow-y-auto md:flex-row">
            <div class="h-32 md:h-auto md:w-1/2">
                <img class="object-cover w-full h-full dark:hidden" src="{{asset('/images/create-account-office.jpeg')}}" alt="Office"/>
            </div>
            <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                <div class="w-full">
                    <h1 class="mb-4 text-xl font-semibold text-gray-700">
                        Create account
                    </h1>

                    <a href="{{route('redirectToGoogle')}}">
                        <button class="my-4 text-center px-4 py-2 border flex border-slate-200 rounded-lg text-slate-700 hover:border-slate-400 hover:text-slate-900 hover:shadow transition duration-150 ">
                            <img class="w-6 h-6" src="https://www.svgrepo.com/show/475656/google-color.svg" loading="lazy" alt="google logo">
                            <span class="mx-2">Login with Google</span>
                        </button>
                    </a>

                    <form method="POST" action="{{route('post.register')}}">
                        @csrf
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Name</span>
                            <input class="border w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                  name="name" placeholder="Name" value="{{old('name')}}" required/>
                            @error('name')
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </label>
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Email</span>
                            <input class="border w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                   name="email" placeholder="Email" value="{{old('email')}}" required/>
                            @error('email')
                            <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </label>
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Phone</span>
                            <input id="phone" class="w-full mt-1 text-sm focus:border-purple-400 focus:outline-none form-input border"
                                   name="phone" placeholder="Phone number" value="{{old('phone')}}" required/>
                            @error('phone')
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </label>
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Password</span>
                            <input class="border w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                  name="password" placeholder="***************" type="password"/>
                            @error('password')
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </label>
                        <label class="block mt-4 text-sm">
                            <span class="text-gray-700">
                              Confirm password
                            </span>
                            <input class="border w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                   name="password_confirmation" placeholder="***************" type="password"/>
                            @error('password_confirmation')
                                <p class="text-red-600">{{ $message }}</p>
                            @enderror
                        </label>

                        <button type="submit" class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Create account
                        </button>
                    </form>

                    <p class="mt-4">
                        <a class="text-sm font-medium text-purple-600 hover:underline" href="{{route('login')}}">
                            Already have an account? Login
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
