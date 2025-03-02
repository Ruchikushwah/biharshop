@extends("admin.adminbase")
@section('title',"manage Category |")

@section('content')



<div class="flex flex-1 flex-col  ">
    <div class="flex flex-1 justify-between items-center p-5">
        <h2 class="border-l-4 border-orange-700  p-1 font-semibold text-xl">Manage Category({{count($categories)}})</h2>
        <button data-modal-target="static-modal" data-modal-toggle="static-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
            create category
        </button>
    </div>
    <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Static modal
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form action="{{route('category.store')}}" method="post">

                        @csrf
                        <div class="mb-3 flex flex-col gap-2">
                            <label for=""> main category</label>
                            <select name="parent_id" class="w-full   border px-3 py-2 rounded">
                                <option value="">main category</option>
                                @foreach($mainCategories as $item)
                                <option value="{{$item->id}}">{{$item->cat_title}}</option>
                                @endforeach
                            </select>
                            @error('parent_id')
                            <p class="text-xs text-red-500">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col mb-3 gap-2 ">
                            <label for="">category title</label>
                            <input type="text" name="cat_title" class="border rounded px-3 oy-2 text-xl">
                            @error('cat_title')
                            <p class="text-xs text-red-500">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col mb-3  gap-2">
                            <label for="">category description</label>
                            <textarea rows="5" name="cat_description" class="border rounded px-3 oy-2 text-xl"></textarea>
                            @error('cat_description')
                            <p class="text-xs text-red-500">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col mb-3  gap-2 bg-teal-600">
                            <input type="submit" value="create category" class=" px-3 py-2 border  text-white  rounded ">

                        </div>
                    </form>

                </div>
                <!-- Modal footer -->

            </div>
        </div>
    </div>
    <div class="flex flex-1">
        @session('error')
        <div class="bg-red-500 text-white p-3 w-full rounded shadow-lg">
            {{session('error')}}
        </div>
        @endsession
        @session('success')
        <div class="bg-green-700 text-white p-3 w-full rounded shadow-lg">
            {{session('success')}}
        </div>
        @endsession

    </div>


    <div class="relative overflow-x-auto">

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        category title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category slug
                    </th>
                    <th scope="col" class="px-6 py-3">
                        category description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        category parent
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $cat)

                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$cat->id}}
                    </th>
                    <td class="px-6 py-4">
                        {{$cat->cat_title}}
                    </td>
                    <td class="px-6 py-4">
                        {{$cat->cat_slug}}
                    </td>
                    <td class="px-6 py-4">
                        {{$cat->cat_description}}
                    </td>
                    <td class="px-6 py-4">
                        @if ($cat->parent == NULL)
                        {{'main category'}}
                        @else
                        {{$cat->parent->cat_title}}
                        @endif
                    </td>
                    <td class="px-6 py-4 flex gap-2">

                        
                        <button type="button" data-modal-target="editbox{{$cat->id}}" data-modal-toggle="editbox{{$cat->id}}" class="bg-blue-600 hover:bg-blue-800 text-white px-3 py-2 rounded">Edit</button>
                        <div class="flex flex-1 flex-col gap-5 ">
                       
                        <div id="editbox{{$cat->id}}" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        edit {{$cat->cat_title}}`s category records
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="editbox{{$cat->id}}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5 space-y-4">
                                        <form action="{{route('category.update',$cat)}}" method="post">

                                            @csrf
                                            @method('put')
                                            <div class="mb-3 flex flex-col gap-2">
                                                <label for=""> main category</label>
                                                <select name="parent_id" class="w-full   border px-3 py-2 rounded">
                                                    @if($cat->parent == NULL)
                                                    <option value="">main category</option>
                                                    @else
                                                    <option value="">{{$cat->parent->cat_title}}</option>
                                                    @endif


                                                    @foreach($mainCategories as $item)
                                                    <option value="{{$item->id}}">{{$item->cat_title}}</option>
                                                    @endforeach
                                                </select>
                                                @error('parent_id')
                                                <p class="text-xs text-red-500">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="flex flex-col mb-3 gap-2 ">
                                                <label for="">category title</label>
                                                <input type="text" name="cat_title" value="{{$cat->cat_title}}" class="border rounded px-3 oy-2 text-xl">
                                                @error('cat_title')
                                                <p class="text-xs text-red-500">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="flex flex-col mb-3  gap-2">
                                                <label for="">category description</label>
                                                <textarea rows="5" name="cat_description" class="border rounded px-3 oy-2 text-xl">{{$cat->cat_description}}</textarea>
                                                @error('cat_description')
                                                <p class="text-xs text-red-500">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="flex flex-col mb-3  gap-2 bg-teal-600">
                                                <input type="submit" value="update  category" class=" px-3 py-2 border  text-white  rounded ">

                                            </div>
                                        </form>

                                    </div>
                                    <!-- Modal footer -->

                                </div>
                            </div>
                        </div>

                        <form action="{{route('category.destroy',$cat)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-800 text-white px-3 py-2 rounded ">Delete</button>
                        </form>
                    </td>


                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>




@endsection