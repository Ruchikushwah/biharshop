<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Admin Panel | {{env('APP_NAME')}}</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body>
    <div class="flex flex-1 bg-slate-700 py-4 px-[10%] text-white  justify-between">
        <a href="{{route('admin.dashboard')}}" class="text-2xl font-semibold">Admin panel</a>

        <div class="flex ">
            <a href="{{route('auth.logout')}}" class="bg-red-500 px-3 py-2 rounded">Logout</a>
        </div>
    </div>
    <div class="flex flex-1 gap-5">
        <div class="w-2/12 bg-slate-200 h-screen flex flex-col ">
            <a href="{{route('admin.dashboard')}}" class="text-slate-800 py-2 hover:bg-slate-300">Dashboard</a>
            <a href="{{route('category.index')}}" class="text-slate-800 py-2  hover:bg-slate-300">Manage Categories</a>
            <a href="{{route('products.index')}}" class="text-slate-800 py-2  hover:bg-slate-300">Manage Product</a>
            <a href="{{route('products.create')}}" class="text-slate-800 py-2  hover:bg-slate-300">insert Product</a>
            <a href="" class="text-slate-800 py-2  hover:bg-slate-300">Manage Oders</a>
            <a href="" class="text-slate-800 py-2  hover:bg-slate-300">Manage Payment</a>
            <a href="" class="text-slate-800 py-2  hover:bg-slate-300">Manage static page</a>
            <a href="" class="text-slate-800 py-2  hover:bg-slate-300">setting</a>




        </div>
        <div class="w-10/12">
            @section('content')
            @show
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    @yield('js')
</body>

</html>