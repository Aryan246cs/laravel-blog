<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 min-h-screen font-sans">
    @auth
    
        <div class="border-2 border-black p-6 m-4 bg-white rounded-lg shadow">
            <p class="font-semibold text-green-700 mb-2">Congrats you are logged in.</p>
            <hr class="mb-4">

            <h1 class="text-2xl font-bold mb-4">User Dashboard</h1>

            <div class="bg-blue-200 p-2 w-40 h-40 mb-4 flex items-center justify-center">
                @if(Auth::user()->profile_image)
                    <img src="{{ asset('storage/' . Auth::user()->profile_image) }}"
                        class="w-36 h-36 object-cover rounded-full">
                @else
                    <p class="text-sm text-gray-600">No profile image set.</p>
                @endif
            </div>

            <table class="w-full text-left border border-gray-300 mb-4">
                <tr class="bg-gray-200">
                    <th class="p-2">Name</th>
                    <td class="p-2">{{ auth()->user()->name }}</td>
                </tr>
                <tr>
                    <th class="p-2 bg-gray-200">Email</th>
                    <td class="p-2">{{ auth()->user()->email }}</td>
                </tr>
                <tr>
                    <th class="p-2 bg-gray-200">Gender</th>
                    <td class="p-2">{{ auth()->user()->gender }}</td>
                </tr>
                <tr>
                    <th class="p-2 bg-gray-200">Date of Birth</th>
                    <td class="p-2">{{ auth()->user()->dob }}</td>
                </tr>
                <tr>
                    <th class="p-2 bg-gray-200">State</th>
                    <td class="p-2">{{ auth()->user()->state }}</td>
                </tr>
                <tr>
                    <th class="p-2 bg-gray-200">District</th>
                    <td class="p-2">{{ auth()->user()->district }}</td>
                </tr>
            </table>

            <div class="mb-6">
                <a href="{{ route('dashboard.edit') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mr-2">Edit Profile</a>

                <form action="{{ route('dashboard.delete') }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded mr-2">Delete Profile</button>
                </form>

                <form action="/logout" method="POST" class="inline">
                    @csrf
                    <button class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-900">Log out</button>
                </form>
            </div>
        </div>

    @else
        <div class="border-2 border-black p-6 m-4 bg-white rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Register</h2>
            <form action="/register" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input name="name" type="text" placeholder="Name" class="w-full border px-3 py-2 rounded">
                <input name="email" type="email" placeholder="Email" class="w-full border px-3 py-2 rounded">
                <input name="password" type="password" placeholder="Password" class="w-full border px-3 py-2 rounded">
                Profile Image<small>(optional)</small>:
                <input type="file" name="profile_image" accept="image/*">
                <div>
                    Gender:
                    <label><input type="radio" name="gender" value="male" class="mr-1"> Male</label>
                    <label><input type="radio" name="gender" value="female" class="mx-2"> Female</label>
                    <label><input type="radio" name="gender" value="other" class="mr-1"> Other</label>
                </div>
                Date of Birth:
                <input type="date" name="dob" class="border px-3 py-2 rounded">
                <div>
                    State:
                    <select id="state" name="state" class="border px-3 py-2 rounded w-full">
                        <option value="">-- Select State --</option>
                        @foreach (json_decode(file_get_contents(public_path('states_districts.json')), true) as $state => $districts)
                            <option value="{{ $state }}">{{ $state }}</option>
                        @endforeach
                    </select>
                    District:
                    <select id="district" name="district" class="border px-3 py-2 rounded w-full">
                        <option value="">-- Select District --</option>
                    </select>
                </div>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Register</button>
            </form>
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

        <div class="border-2 border-black p-6 m-4 bg-white rounded-lg shadow">
            <h2 class="text-xl font-bold mb-4">Log In</h2>
            <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
                @csrf
                <input name="loginname" type="text" placeholder="Username" class="w-full border px-3 py-2 rounded">
                <input name="loginpassword" type="password" placeholder="Password" class="w-full border px-3 py-2 rounded">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Log in</button>
            </form>
        </div>

        <div class="text-center mt-6">
            <a href="{{ url('/explore-posts') }}"
                class="inline-block bg-indigo-500 hover:bg-indigo-600 text-white px-5 py-2 rounded">View Public Posts</a>
        </div>
    @endauth
</body>

</html>