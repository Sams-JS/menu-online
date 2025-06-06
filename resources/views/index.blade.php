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
        <a href="/admin/login" class="fixed top-4 right-4 z-10 text-orange-400 hover:text-orange-500 transition" title="Login Admin">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="size-7" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
            </svg>
        </a>
    </header>

    <div class="px-4">
        <input type="text" placeholder="Cari menu" class="border rounded-lg w-full p-2 mb-6" />
    </div>

    {{-- Navbar --}}
    <navbar id="navbar" class="p-4 flex justify-center bg-neutral-50 w-full">
        <ul class="flex gap-3 md:gap-5">
            @foreach ($categories as $category)
            <li><a href="#{{ $category->category_name }}" class="text-xs md:text-base lg:text-lg font-bold rounded-lg text-neutral-400 hover:text-neutral-950 transition duration-300 ease-in-out">{{ $category->category_name }}</a></li>
            @endforeach
        </ul>
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
                    <a class="text-white text-xs md:text-sm xl:text-base inline bg-orange-400 hover:bg-neutral-50 hover:text-orange-400 border border-orange-400 py-1 px-2 rounded-full transition duration-300 ease-in-out" href="{{ $product->shopeefood_link }}" target="_blank">
                        ShopeeFood
                    </a>
                    <a class="text-white text-xs md:text-sm xl:text-base inline bg-orange-400 hover:bg-neutral-50 hover:text-orange-400 border border-orange-400 py-1 px-2 rounded-full transition duration-300 ease-in-out" href="{{ $product->gofood_link }}" target="_blank">
                        GoFood
                    </a>
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

        window.addEventListener("scroll", () => {
            if (window.pageYOffset >= navbarOffsetTop) {
                navbar.classList.add("fixed", "top-0", "shadow-md");
                placeholder.style.display = "block";
                placeholder.style.height = `${navbarHeight}px`;
            } else {
                navbar.classList.remove("fixed", "top-0", "shadow-md");
                placeholder.style.display = "none";
            }
        });
    </script>
</body>
</html>

