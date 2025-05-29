<x-guest-layout>
        <form method="POST" action="{{ route('admin.register') }}"
              class="w-full max-w-sm bg-white rounded-xl p-6 space-y-4">
            @csrf

            <h2 class="text-2xl font-bold text-center text-gray-800">Admin Register</h2>

            @if ($errors->any())
                <div class="bg-red-100 text-red-600 text-sm p-2 rounded">
                    {{ $errors->first() }}
                </div>
            @endif

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input id="name" name="name" type="text" required
                       class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" name="email" type="email" required
                       class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" required
                       class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                       class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition font-semibold">
                Register
            </button>
            <div>Already registered ? <a href="{{ route('admin.login') }}" class="font-bold">Login</a></div>
        </form>
</x-guest-layout>
