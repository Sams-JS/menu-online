<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tahu Baso Mas Pendek</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    
</head>
<body class="bg-white">

    {{-- Header --}}
    <header class="relative flex justify-center">
        <img src="assets/header.jpg" alt="" class="w-full">

        <div class="fixed top-4 right-4 md:right-8 z-10 flex items-center gap-2" id="headerControls">
            <!-- Dropdown kategori -->
            <div class="relative" id="dropdownContainer">
                <button id="dropdownToggle" class="text-xs md:text-sm font-bold text-neutral-600 hover:text-neutral-900 border border-neutral-300 rounded px-2 py-1 bg-white shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div id="dropdownMenu" class="absolute right-0 mt-2 w-40 bg-white border border-neutral-300 rounded shadow-lg z-20 hidden">
                    <ul class="max-h-60 overflow-y-auto text-sm">
                        @foreach ($categories as $category)
                        <li>
                            <a href="#{{ $category->category_name }}" class="block px-4 py-2 hover:bg-neutral-100 transition">
                                {{ $category->category_name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <a id="adminLoginLink" href="/admin/login" class="text-orange-400 hover:text-orange-500 transition" title="Login Admin">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="size-7" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </header>

    <div class="px-4 relative">
        <input type="text" id="searchInput" placeholder="Cari menu" class="border rounded-lg w-full p-2 mb-6" autocomplete="off" />
        <ul id="searchResults" class="absolute bg-white border rounded-md max-h-60 overflow-auto shadow-lg hidden"></ul>
    </div>

    {{-- Navbar --}}
    <navbar id="navbar" class="py-4 px-4 md:px-8 flex items-center justify-between gap-3 bg-white w-full">
        <div id="categoryNavbar" class="overflow-x-auto whitespace-nowrap max-w-full mx-auto">
            <ul class="inline-flex gap-3 md:gap-5">
                @foreach ($categories as $category)
                <li>
                    <a href="#{{ $category->category_name }}" class="text-base lg:text-lg font-bold rounded-lg text-neutral-400 hover:text-neutral-950 transition duration-300 ease-in-out">
                        {{ $category->category_name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

        <div id="navbarControls" class="hidden items-center gap-2 ml-auto"></div>
    </navbar>
    {{-- Placeholder pengganti navbar agar smooth --}}
    <div id="navbarPlaceholder" style="display: none;"></div>

    {{-- Content --}}
    @foreach ($categories as $category)
    @if ($menus->where('category_id', $category->id)->count()>0)
    <h1 id="{{ $category->category_name }}" class="text-2xl font-semibold ps-6 mb-4">{{ $category->category_name }}</h1>
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 px-6 mb-8">
        @foreach ($menus->where('category_id', $category->id) as $menu)
        <div id="menu-{{ $menu->id }}" class="bg-white rounded-lg shadow-md grid grid-cols-3 gap-2 border-1 border-gray-300">
            <div class="aspect-square w-full m-3 overflow-hidden rounded-lg border-1 border-gray-300 justify-self-start ">
                <img src="storage/{{ $menu->image }}" alt="Dish" class="w-full h-full object-cover object-center " />
            </div>
            <div class="grid mx-4 mt-4 col-span-2">
                <div>
                    <h3 class="font-semibold text-sm md:text-base lg:text-lg">{{ $menu->menu_name }}</h3>
                    <p class="text-gray-600 text-sm md:text-base">Rp. {{ number_format($menu->price, 0, ',', '.') }}</p>
                </div>
                <div class="link flex gap-2 place-self-end mb-4 lg:mb-3 xl:mb-4">
                    @if($menu->shopeefood_link)
                        <a class="text-white text-xs md:text-sm xl:text-base inline bg-orange-400 hover:bg-white hover:text-orange-400 border border-orange-400 py-1 px-2 rounded-full transition duration-300 ease-in-out" href="{{ $menu->shopeefood_link }}" target="_blank">
                            ShopeeFood
                        </a>
                    @else
                        <span class="text-gray-500 text-xs md:text-sm xl:text-base inline bg-gray-300 py-1 px-2 rounded-full">
                            ShopeeFood
                        </span>
                    @endif

                    @if($menu->gofood_link)
                        <a class="text-white text-xs md:text-sm xl:text-base inline bg-orange-400 hover:bg-white hover:text-orange-400 border border-orange-400 py-1 px-2 rounded-full transition duration-300 ease-in-out" href="{{ $menu->gofood_link }}" target="_blank">
                            GoFood
                        </a>
                    @else
                        <span class="text-gray-500 text-xs md:text-sm xl:text-base inline bg-gray-300 py-1 px-2 rounded-full">
                            ShopeeFood
                        </span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </section>
    @endif
    @endforeach

    {{-- Footer --}}
    <footer class="bg-orange-400 flex flex-col items-center justify-center gap-2 p-4 md:flex-row md:justify-center md:gap-4">
        <p class="text-white text-xs md:text-base">&copy;2025 Tahu Baso Khas Semarang Mas Pendek.</p>
        <span class="text-white hidden md:inline">|</span>
        <a href="https://wa.me/6289637877707" target="_blank" class="flex items-center text-white text-xs md:text-base">
            <!-- WhatsApp Icon -->
            <svg class="w-4 h-4 mr-1 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M20.52 3.48A11.88 11.88 0 0012 0C5.38 0 .01 5.37 0 12a11.9 11.9 0 001.64 6L0 24l6.37-1.67a11.86 11.86 0 005.63 1.44h.01c6.62 0 12-5.37 12-12 0-3.2-1.25-6.21-3.48-8.52zM12 22.1a10.1 10.1 0 01-5.14-1.4l-.37-.22-3.78.99 1-3.68-.24-.38A10.1 10.1 0 012 12C2 6.48 6.48 2 12 2s10 4.48 10 10-4.48 10.1-10 10.1zm5.48-7.53c-.3-.15-1.78-.88-2.06-.97-.27-.1-.47-.15-.67.15s-.77.97-.94 1.17c-.17.2-.35.22-.64.07s-1.25-.46-2.38-1.46a8.9 8.9 0 01-1.64-2.04c-.17-.3 0-.46.13-.6.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.38 0-.53s-.67-1.6-.92-2.2c-.24-.58-.49-.5-.67-.5l-.57-.01c-.2 0-.52.07-.8.38s-1.05 1.03-1.05 2.5 1.07 2.9 1.22 3.1c.15.2 2.1 3.2 5.07 4.48.7.3 1.25.47 1.68.6.7.22 1.33.19 1.83.12.56-.08 1.78-.73 2.03-1.44.25-.7.25-1.3.18-1.44-.07-.13-.27-.2-.57-.35z"/>
            </svg>
            <span>0896-3787-7707</span>
        </a>
    </footer>


    {{-- JavaScript --}}
    <script>
        // Ambil semua produk dan simpan ke array untuk pencarian
        const menus = [
            @foreach($menus as $menu)
            {
                id: "{{ $menu->id }}",
                name: "{{ $menu->menu_name }}",
                category: "{{ $categories->find($menu->category_id)->category_name }}"
            },
            @endforeach
        ];
    </script>
</body>
</html>

