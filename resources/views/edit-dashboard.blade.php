<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-900 to-gray-800 min-h-screen flex items-center justify-center px-4 text-gray-100">
    <div class="bg-gray-800 p-8 rounded-xl shadow-2xl w-full max-w-2xl border border-gray-800">
        <h1 class="text-3xl font-bold text-center text-indigo-400 mb-6">Edit Your Profile</h1>

        <form action="{{ route('dashboard.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold text-gray-200 mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full bg-gray-800 text-gray-100 border border-gray-700 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div>
                <label class="block font-semibold text-gray-200 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full bg-gray-800 text-gray-100 border border-gray-700 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div>
                <label class="block font-semibold text-gray-200 mb-1">Gender</label>
                <div class="flex gap-6 mt-1 text-gray-300">
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="gender" value="male" {{ $user->gender == 'male' ? 'checked' : '' }}
                            class="accent-indigo-500">
                        <span>Male</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="gender" value="female" {{ $user->gender == 'female' ? 'checked' : '' }}
                            class="accent-indigo-500">
                        <span>Female</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="radio" name="gender" value="other" {{ $user->gender == 'other' ? 'checked' : '' }}
                            class="accent-indigo-500">
                        <span>Other</span>
                    </label>
                </div>
            </div>

            <div>
                <label class="block font-semibold text-gray-200 mb-1">Date of Birth</label>
                <input type="date" name="dob" value="{{ old('dob', $user->dob) }}"
                    class="w-full bg-gray-800 text-gray-100 border border-gray-700 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div>
                <label class="block font-semibold text-gray-200 mb-1">State</label>
                <input type="text" name="state" value="{{ old('state', $user->state) }}"
                    class="w-full bg-gray-800 text-gray-100 border border-gray-700 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div>
                <label class="block font-semibold text-gray-200 mb-1">District</label>
                <input type="text" name="district" value="{{ old('district', $user->district) }}"
                    class="w-full bg-gray-800 text-gray-100 border border-gray-700 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            </div>

            <div>
                <label class="block font-semibold text-gray-200 mb-1">Profile Image</label>
                <input type="file" name="profile_image"
                    class="w-full bg-gray-800 text-gray-100 border border-gray-700 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200" />
            </div>

            <div class="text-center pt-4">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-md transition duration-200 shadow-md">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
</body>

</html>
