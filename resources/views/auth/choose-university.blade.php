<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Your University</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-xl bg-white rounded-2xl shadow-xl p-8">

        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900">
                Choose Your University
            </h1>

            <p class="text-gray-600 mt-2">
                Select your institution before continuing.
            </p>
        </div>

        <form method="POST" action="{{ route('choose.university.store') }}">

            @csrf

            <div class="mb-6">

                <label class="block mb-2 font-semibold text-gray-700">
                    Search Institution
                </label>

                <select
                    name="institution_id"
                    required
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500"
                >

                    <option value="">
                        -- Select Institution --
                    </option>

                    @foreach($institutions as $institution)

                        <option value="{{ $institution->id }}">
                            {{ $institution->name }}
                        </option>

                    @endforeach

                </select>

                @error('institution_id')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <button
                type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg transition"
            >
                Continue Registration
            </button>

        </form>

    </div>

</body>
</html>