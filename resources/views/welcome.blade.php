<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Side Navbar</title>
    <style>
        /* Set a fixed height for the body to simulate content */
        body {
            height: 2000px;
        }
    </style>
</head>
<body>
<!-- Sidebar -->
<div class="flex h-screen">
    <!-- Sidebar component -->
    <div class="flex flex-col bg-gray-800 text-white w-20">
        <!-- Logo -->
        <div class="h-20 flex items-center justify-center">
            <a href="#">
                <img src="logo.png" alt="Logo" class="w-8 h-8">
            </a>
        </div>
        <!-- Navigation links -->
        <div class="flex flex-col flex-grow">
            <a href="#" class="p-4 hover:bg-gray-700">Home</a>
            <a href="#" class="p-4 hover:bg-gray-700">About</a>
            <a href="#" class="p-4 hover:bg-gray-700">Services</a>
            <a href="#" class="p-4 hover:bg-gray-700">Contact</a>
        </div>
    </div>
    <!-- Main content -->
    <div class="flex flex-col flex-grow bg-gray-200">
        <!-- Content goes here -->
    </div>
</div>
</body>
</html>
