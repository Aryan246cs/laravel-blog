<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-gray-100 min-h-screen font-sans">
    @auth
        <div class="max-w-3xl mx-auto mt-6 p-6 bg-gray-800 border border-gray-700 rounded-lg shadow-md">
            <p class="text-green-400 font-semibold mb-4">✅ Congrats! You're logged in.</p>

            <h1 class="text-2xl font-bold mb-6 border-b border-gray-600 pb-2">User Dashboard</h1>

            <div class="flex justify-center mb-6">
                @if(Auth::user()->profile_image)
                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" class="w-36 h-36 rounded-full object-cover border-4 border-blue-400 shadow">
                @else
                    <div class="w-36 h-36 rounded-full bg-gray-700 flex items-center justify-center text-sm text-gray-300">
                        No Image
                    </div>
                @endif
            </div>

            <table class="w-full text-sm border border-gray-700 rounded overflow-hidden">
                <tr class="bg-gray-700">
                    <th class="p-3 font-medium text-left">Name</th>
                    <td class="p-3">{{ auth()->user()->name }}</td>
                </tr>
                <tr>
                    <th class="p-3 bg-gray-800">Email</th>
                    <td class="p-3">{{ auth()->user()->email }}</td>
                </tr>
                <tr>
                    <th class="p-3 bg-gray-700">Gender</th>
                    <td class="p-3">{{ auth()->user()->gender }}</td>
                </tr>
                <tr>
                    <th class="p-3 bg-gray-800">Date of Birth</th>
                    <td class="p-3">{{ auth()->user()->dob }}</td>
                </tr>
                <tr>
                    <th class="p-3 bg-gray-700">State</th>
                    <td class="p-3">{{ auth()->user()->state }}</td>
                </tr>
                <tr>
                    <th class="p-3 bg-gray-800">District</th>
                    <td class="p-3">{{ auth()->user()->district }}</td>
                </tr>
            </table>

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('dashboard.edit') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Edit Profile</a>

                <form action="{{ route('dashboard.delete') }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Delete Profile</button>
                </form>

                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded">Log Out</button>
                </form>
            </div>
        </div>
    @else
        {{-- Register --}}
        <div class="max-w-2xl mx-auto mt-6 p-6 bg-gray-800 rounded-lg shadow border border-gray-700">
            <h2 class="text-xl font-bold mb-4">Register</h2>
            <form action="/register" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input name="name" type="text" placeholder="Name" class="w-full bg-gray-900 border border-gray-700 text-gray-100 px-3 py-2 rounded">
                <input name="email" type="email" placeholder="Email" class="w-full bg-gray-900 border border-gray-700 text-gray-100 px-3 py-2 rounded">
                <input name="password" type="password" placeholder="Password" class="w-full bg-gray-900 border border-gray-700 text-gray-100 px-3 py-2 rounded">

                <div>
                    <label class="block mb-1 text-sm text-gray-300">Profile Image (optional):</label>
                    <input type="file" name="profile_image" accept="image/*" class="text-sm text-gray-300">
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm text-gray-300">Gender:</label>
                    <div class="flex gap-4">
                        <label><input type="radio" name="gender" value="male" class="mr-1"> Male</label>
                        <label><input type="radio" name="gender" value="female" class="mr-1"> Female</label>
                        <label><input type="radio" name="gender" value="other" class="mr-1"> Other</label>
                    </div>
                </div>

                <div>
                    <label class="block mb-1 text-sm text-gray-300">Date of Birth:</label>
                    <input type="date" name="dob" class="w-full bg-gray-900 border border-gray-700 text-gray-100 px-3 py-2 rounded">
                </div>

                <div>
                    <label class="block mb-1 text-sm text-gray-300">State:</label>
                    <select id="state" name="state" class="border border-gray-700 bg-gray-900 text-gray-100 px-3 py-2 rounded w-full">
                        <option value="">-- Select State --</option>
                        @foreach (json_decode(file_get_contents(public_path('states_districts.json')), true) as $state => $districts)
                            <option value="{{ $state }}">{{ $state }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-sm text-gray-300">District:</label>
                    <select id="district" name="district" class="border border-gray-700 bg-gray-900 text-gray-100 px-3 py-2 rounded w-full">
                        <option value="">-- Select District --</option>
                    </select>
                </div>

                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Register</button>
            </form>
        </div>

        {{-- Login --}}
        <div class="max-w-2xl mx-auto mt-6 p-6 bg-gray-800 rounded-lg shadow border border-gray-700">
            <h2 class="text-xl font-bold mb-4">Log In</h2>
            <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
                @csrf
                <input name="loginname" type="text" placeholder="Username" class="w-full bg-gray-900 border border-gray-700 text-gray-100 px-3 py-2 rounded">
                <input name="loginpassword" type="password" placeholder="Password" class="w-full bg-gray-900 border border-gray-700 text-gray-100 px-3 py-2 rounded">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Log In</button>
            </form>
        </div>

        <div class="text-center mt-6">
            <a href="{{ url('/explore-posts') }}"
                class="inline-block bg-indigo-500 hover:bg-indigo-600 text-white px-5 py-2 rounded">View Public Posts</a>
        </div>

        <script>
            document.getElementById('state').addEventListener('change', function () {
                const state = this.value;
                const districtSelect = document.getElementById('district');

                districtSelect.innerHTML = '<option value="">Loading...</option>';

                fetch(`/districts/${encodeURIComponent(state)}`)
                    .then(res => res.json())
                    .then(data => {
                        districtSelect.innerHTML = '<option value="">-- Select District --</option>';
                        data.forEach(district => {
                            const opt = document.createElement('option');
                            opt.value = district;
                            opt.innerHTML = district;
                            districtSelect.appendChild(opt);
                        });
                    });
            });
        </script>
    @endauth
</body>

</html>
