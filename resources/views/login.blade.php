<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <title>Login Page</title>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
<div class="max-w-md w-full p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Login</h1>
    <form method="POST">
        @csrf
        <div class="mb-4">
            <label for="username" class="block mb-2 text-sm font-medium text-gray-600">Username</label>
            <input type="text" id="username" value="{{old('username')}}" name="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-400" required>
            @if ($errors->has('username'))
                <p class="text-red-500" style="font-size: 0.8em">
                    {{ $errors->first('username') }}
                </p>
            @endif
        </div>
        <div class="mb-4">
            <label for="password" class="block mb-2 text-sm font-medium text-gray-600">Password</label>
            <div class="flex gap-1">
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-400" required>
                <span class="flex items-center"><a role="button" id="btnShow" onclick="showPass(this,'password')" class="hide"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                    </a>
                                </span>
            </div>
            @if ($errors->has('password'))
                <p class="text-red-500" style="font-size: 0.8em">
                    {{ $errors->first('password') }}
                </p>
            @endif
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">Login</button>
    </form>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


<script>
    function showPass(a, field) {
        if ($(a)[0].className == 'show') {
            $(a).removeClass('show').addClass('hide');
            $(a).html('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\n' +
                '                                      <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />\n' +
                '                                    </svg>')
            $('#' + field).get(0).type = 'password'
        } else {
            $(a).removeClass('hide').addClass('show');
            $(a).html('<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">\n' +
                '                                    <path stroke-linecap="round" stroke-linejoin="round"\n' +
                '                                          d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>\n' +
                '                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>\n' +
                '                                    </svg>')

            $('#' + field).get(0).type = 'text'
        }
    }
</script>
</body>

</html>
