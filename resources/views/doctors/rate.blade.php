@extends('profile')

@section('content')
<div class="container mx-auto p-4 max-w-md">
    <h2 class="text-xl font-semibold mb-4">
        Rate Dr. {{ $doctor->user->name ?? $doctor->doctor_ref }}
    </h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('doctors.rate.submit', $doctor) }}" method="POST">
        @csrf

        <div class="flex space-x-2 mb-4">
            @for($i = 1; $i <= 5; $i++)
                <label class="cursor-pointer">
                    <input 
                        type="radio" 
                        name="rating" 
                        value="{{ $i }}" 
                        {{ (old('rating', $doctor->rating) == $i) ? 'checked' : '' }}
                        class="hidden"
                    />
                    <svg 
                        class="w-8 h-8 inline-block" 
                        fill="{{ (old('rating', $doctor->rating) >= $i) ? 'currentColor' : 'none' }}" 
                        stroke="currentColor" viewBox="0 0 20 20"
                    >
                        <polygon points="9.9,1.1 12.3,6.9 18.7,7.5 13.9,11.8 15.3,17.9 9.9,14.2 4.5,17.9 5.9,11.8 1.1,7.5 7.5,6.9"/>
                    </svg>
                </label>
            @endfor
        </div>
        @error('rating')
            <p class="text-red-600 text-sm mb-3">{{ $message }}</p>
        @enderror

        <button 
            type="submit" 
            class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700"
        >
            Submit Rating
        </button>
    </form>
</div>
@endsection
