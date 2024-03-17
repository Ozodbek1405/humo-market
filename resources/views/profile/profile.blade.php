@extends('layouts.master')
@section('title')
    PROFILE
@endsection

@section('content')

    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                        </ol>
                    </nav>
                    <a href="{{route('change.profile.password',auth()->id())}}">
                        <button class="alert alert-info">
                            Change password
                        </button>
                    </a>
                    <a href="{{route('logout.perform')}}">
                        <button class="alert alert-primary">
                            Logout
                        </button>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-4">
                        <form method="POST" action="{{route('change.profile',auth()->id())}}">
                            @csrf
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Name</span>
                                <input class="border w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                       name="name" placeholder="Name" value="{{old('name',auth()->user()->name)}}" required/>
                                @error('name')
                                <p class="text-red-600">{{ $message }}</p>
                                @enderror
                            </label>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Email</span>
                                <input class="border w-full mt-1 text-sm focus:border-purple-400 focus:outline-none focus:shadow-outline-purple form-input"
                                       name="email" placeholder="Email" value="{{old('email',auth()->user()->email)}}" required/>
                                @error('email')
                                <p class="text-red-600">{{ $message }}</p>
                                @enderror
                            </label>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Phone</span>
                                <input id="phone" class="w-full mt-1 text-sm focus:border-purple-400 focus:outline-none form-input border"
                                       name="phone" placeholder="Phone number" value="{{old('phone',auth()->user()->phone)}}" required/>
                                @error('phone')
                                <p class="text-red-600">{{ $message }}</p>
                                @enderror
                            </label>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <button type="submit" class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Change information
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
