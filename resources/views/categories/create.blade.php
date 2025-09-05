@extends('layouts.app')

@section('title', 'Create Category')
@section('content')
    <div class="min-h-screen bg-stone-300 pt-10">
        <div class="max-w-2xl mx-auto  bg-white shadow-lg rounded-xl p-6 ">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Create Category</h1>

            {{-- Error Alert --}}
            @if ($errors->any())
                <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-300 text-red-700">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('categories.store') }}" method="POST" class="space-y-5">
                @csrf
                {{-- Input Field --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-stone-500 focus:border-stone-500 @error('name') border-red-500 @enderror"
                        required>
                    @error('name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end text-end space-x-3">
                    <a href="{{ route('categories.index') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition ">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
