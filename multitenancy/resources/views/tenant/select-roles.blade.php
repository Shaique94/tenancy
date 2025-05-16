<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Select Roles for Your Hospital</h2>

    <form method="POST" action="{{ route('tenant.roles.store') }}">
        @csrf

        @foreach ($templates as $template)
            <div class="mb-3">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="roles[]" value="{{ $template->id }}" class="mr-2">
                    <span class="font-semibold">{{ $template->name }}</span>
                </label>
                <div class="ml-6 text-sm text-gray-600">
                    Permissions: {{ $template->permissions->pluck('name')->join(', ') }}
                </div>
            </div>
        @endforeach

        <button class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Save and Continue
        </button>
    </form>
</div>
</body>
</html>