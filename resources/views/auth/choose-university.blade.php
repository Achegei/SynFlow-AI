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
                Choose Your Institution/College/University
            </h1>

            <p class="text-gray-600 mt-2">
                Select your institution before continuing.
            </p>
        </div>

        <div class="mb-6 grid grid-cols-2 gap-3">
            <button
                type="button"
                id="institution-option"
                aria-pressed="true"
                class="rounded-xl border-2 border-indigo-600 bg-indigo-50 p-4 text-left transition"
            >
                <span class="block font-semibold text-gray-900">Institution</span>
                <span class="mt-1 block text-sm text-gray-600">
                    Join through your school, college or university.
                </span>
            </button>

            <button
                type="button"
                id="other-option"
                aria-pressed="false"
                class="rounded-xl border-2 border-gray-200 bg-white p-4 text-left transition"
            >
                <span class="block font-semibold text-gray-900">Other</span>
                <span class="mt-1 block text-sm text-gray-600">
                    Register independently.
                </span>
            </button>
        </div>

        <form method="POST" action="{{ route('choose.university.store') }}" id="registration-form">

            <input
                type="hidden"
                name="registration_context"
                id="registration-context"
                value="institution"
            >

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

        <script>
            const institutionOption = document.getElementById('institution-option');
            const otherOption = document.getElementById('other-option');
            const registrationContext = document.getElementById('registration-context');
            const institutionSelect = document.querySelector('[name="institution_id"]');
            const institutionField = institutionSelect.closest('.mb-6');

            function selectPath(path) {
                const isInstitution = path === 'institution';

                registrationContext.value = path;
                institutionField.hidden = !isInstitution;
                institutionSelect.required = isInstitution;

                if (!isInstitution) {
                    institutionSelect.value = '';
                }

                for (const [button, selected] of [
                    [institutionOption, isInstitution],
                    [otherOption, !isInstitution],
                ]) {
                    button.setAttribute('aria-pressed', String(selected));
                    button.classList.toggle('border-indigo-600', selected);
                    button.classList.toggle('bg-indigo-50', selected);
                    button.classList.toggle('border-gray-200', !selected);
                    button.classList.toggle('bg-white', !selected);
                }
            }

            institutionOption.addEventListener('click', () => selectPath('institution'));
            otherOption.addEventListener('click', () => selectPath('other'));

            selectPath('institution');
        </script>

    </div>

</body>
</html>