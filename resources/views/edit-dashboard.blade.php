<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-xl">
        <h1 class="text-2xl font-bold mb-6 text-center text-blue-600">Edit Profile</h1>

        <form action="{{ route('dashboard.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold">Name:</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label class="block font-semibold">Email:</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label class="block font-semibold">Gender:</label>
                <div class="mt-1 space-x-4">
                    <label><input type="radio" name="gender" value="male" {{ $user->gender == 'male' ? 'checked' : '' }}>
                        Male</label>
                    <label><input type="radio" name="gender" value="female"
                            {{ $user->gender == 'female' ? 'checked' : '' }}> Female</label>
                    <label><input type="radio" name="gender" value="other"
                            {{ $user->gender == 'other' ? 'checked' : '' }}> Other</label>
                </div>
            </div>

            <div>
                <label class="block font-semibold">Date of Birth:</label>
                <input type="date" name="dob" value="{{ old('dob', $user->dob) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label class="block font-semibold">State:</label>
                <input type="text" name="state" value="{{ old('state', $user->state) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label class="block font-semibold">District:</label>
                <input type="text" name="district" value="{{ old('district', $user->district) }}"
                    class="w-full border border-gray-300 rounded px-3 py-2 mt-1">
            </div>

            <div>
                <label class="block font-semibold">Profile Image:</label>
                <input type="file" name="profile_image" class="w-full border border-gray-300 rounded mt-1 p-1">
            </div>

            <div class="text-center">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
</body>

</html>
