<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tahu Baso Mas Pendek</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white">

    {{-- Header --}}
    <header class="relative flex justify-center">
        <img src="assets/header.jpg" alt="" class="w-full">

        <div class="fixed top-4 right-4 z-10 flex items-center gap-2" id="headerControls">
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

    <div class="px-4">
        <input type="text" placeholder="Cari menu" class="border rounded-lg w-full p-2 mb-6" />
    </div>

    {{-- Navbar --}}
    <navbar id="navbar" class="p-4 flex items-center justify-between gap-3 bg-white w-full">
        <div class="overflow-x-auto whitespace-nowrap max-w-full mx-auto">
            <ul class="inline-flex gap-3 md:gap-5">
                @foreach ($categories as $category)
                <li>
                    <a href="#{{ $category->category_name }}" class="text-xs md:text-base lg:text-lg font-bold rounded-lg text-neutral-400 hover:text-neutral-950 transition duration-300 ease-in-out">
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
    @if ($products->where('category_id', $category->id)->count()>0)
    <h1 id="{{ $category->category_name }}" class="text-2xl font-semibold ps-6 mb-4">{{ $category->category_name }}</h1>
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 px-6 mb-8">
        @foreach ($products->where('category_id', $category->id) as $product)
        <div class="bg-white rounded-lg shadow-md grid grid-cols-3 gap-2 border-1 border-gray-300">
            <div class="aspect-square w-full m-3 overflow-hidden rounded-lg border-1 border-gray-300 justify-self-start ">
                <img src="storage/{{ $product->image }}" alt="Dish" class="w-full h-full object-cover object-center " />
            </div>
            <div class="grid mx-4 mt-4 col-span-2">
                <div>
                    <h3 class="font-semibold text-sm md:text-base lg:text-lg">{{ $product->product_name }}</h3>
                    <p class="text-gray-600 text-sm md:text-base">Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
                <div class="link flex gap-2 place-self-end mb-4 lg:mb-3 xl:mb-4">
                    @if($product->shopeefood_link)
                        <a class="text-white text-xs md:text-sm xl:text-base inline bg-orange-400 hover:bg-white hover:text-orange-400 border border-orange-400 py-1 px-2 rounded-full transition duration-300 ease-in-out" href="{{ $product->shopeefood_link }}" target="_blank">
                            ShopeeFood
                        </a>
                    @else
                        <span class="text-gray-500 text-xs md:text-sm xl:text-base inline bg-gray-300 py-1 px-2 rounded-full" disabled>
                            ShopeeFood
                        </span>
                    @endif

                    @if($product->gofood_link)
                        <a class="text-white text-xs md:text-sm xl:text-base inline bg-orange-400 hover:bg-neutral-50 hover:text-orange-400 border border-orange-400 py-1 px-2 rounded-full transition duration-300 ease-in-out" href="{{ $product->gofood_link }}" target="_blank">
                            GoFood
                        </a>
                    @else
                        <span class="text-gray-500 text-xs md:text-sm xl:text-base inline bg-gray-300 py-1 px-2 rounded-full" disabled>
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
    <footer class="bg-orange-400 flex justify-center p-4">
        <p class="text-neutral-50 text-xs md:text-base">&copy;2025 Tahu Baso Khas Semarang Mas Pendek.</p>
    </footer>

    {{-- JavaScript --}}
    <script>
        const navbar = document.getElementById("navbar");
        const placeholder = document.getElementById("navbarPlaceholder");
        const navbarOffsetTop = navbar.offsetTop;
        const navbarHeight = navbar.offsetHeight;
        const adminLoginLink = document.getElementById("adminLoginLink");
        const adminLinkContainer = document.getElementById("adminLinkContainer");
        const headerControls = document.getElementById("headerControls");
        const navbarControls = document.getElementById("navbarControls");
        const dropdownContainer = document.getElementById("dropdownContainer");

        window.addEventListener("scroll", () => {
            if (window.pageYOffset >= navbarOffsetTop) {
                navbar.classList.add("fixed", "top-0", "shadow-md");
                placeholder.style.display = "block";
                placeholder.style.height = `${navbarHeight}px`;
                // Pindahkan tombol login ke navbar
                // Pindahkan dropdown dan admin link ke navbar jika belum ada
                if (!navbarControls.contains(dropdownContainer)) {
                    navbarControls.appendChild(dropdownContainer);
                    navbarControls.appendChild(adminLoginLink);
                    // Tambahkan 'flex', hapus 'hidden'
                    navbarControls.classList.remove("hidden");
                    navbarControls.classList.add("flex");
                }
            } else {
                navbar.classList.remove("fixed", "top-0", "shadow-md");
                placeholder.style.display = "none";

                // Kembalikan tombol login ke header
                if (!headerControls.contains(dropdownContainer)) {
                    headerControls.appendChild(dropdownContainer);
                    headerControls.appendChild(adminLoginLink);
                }
                // Sembunyikan: hapus flex, tambahkan hidden
                navbarControls.classList.remove("flex");
                navbarControls.classList.add("hidden");
            }
        });

        // Dropdown toggle
        const dropdownToggle = document.getElementById("dropdownToggle");
        const dropdownMenu = document.getElementById("dropdownMenu");

        dropdownToggle.addEventListener("click", (e) => {
            e.stopPropagation();
            dropdownMenu.classList.toggle("hidden");
        });

        // Tutup dropdown jika klik di luar
        document.addEventListener("click", (e) => {
            if (!dropdownMenu.classList.contains("hidden")) {
                dropdownMenu.classList.add("hidden");
            }
        });
    </script>
</body>
</html>

