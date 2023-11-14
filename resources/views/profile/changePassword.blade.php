@extends('layouts.master')
@section('title')
    Change password
@endsection

@section('content')

    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('profile',$user->id)}}">User Profile</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-4">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                         @if (session('success'))
                             <div class="alert alert-success">
                                 {{ session('success') }}
                             </div>
                         @endif
                        <form action="{{route('changeProfile.password',$user->id)}}" method="POST">
                            @csrf
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Old Password</span>
                                <input class="border w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                       name="old_password" placeholder="***************" type="password"/>
                                @error('old_password')
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
                                Change
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
