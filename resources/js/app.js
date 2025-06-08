import './bootstrap';

const navbar = document.getElementById("navbar");
const categoryNavbar = document.getElementById("categoryNavbar");
const placeholder = document.getElementById("navbarPlaceholder");
const navbarOffsetTop = navbar.offsetTop;
const navbarHeight = navbar.offsetHeight;
const adminLoginLink = document.getElementById("adminLoginLink");
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
            categoryNavbar.classList.remove("mx-auto")
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
        categoryNavbar.classList.add("mx-auto")
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

// Search Bar
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');

    function filterProducts(query) {
        if(!query) return [];
        query = query.toLowerCase();
        return products.filter(p => 
            p.name.toLowerCase().includes(query) ||  // cari di nama produk
            p.category.toLowerCase().includes(query)  // cari di nama kategori
        );
    }

    function clearResults() {
        searchResults.innerHTML = '';
        searchResults.style.display = 'none';
    }

    searchInput.addEventListener('input', function() {
        const query = this.value.trim();
        const filtered = filterProducts(query);
        searchResults.innerHTML = '';

        if(query === '') {
            clearResults();
            return;
        }

        if(filtered.length === 0) {
            searchResults.innerHTML = `<li class="px-4 py-2 text-gray-500 cursor-default">Menu tidak dikenali</li>`;
            searchResults.style.display = 'block';
            return;
        }

        filtered.forEach(product => {
            const li = document.createElement('li');
            li.classList.add('px-4', 'py-2', 'cursor-pointer', 'hover:bg-gray-200');
            li.textContent = `${product.name} - ${product.category}`;
            li.dataset.productId = product.id;
            searchResults.appendChild(li);
        });
        searchResults.style.display = 'block';
    });

    // Ketika klik hasil pencarian, scroll ke produk
    searchResults.addEventListener('click', function(e) {
        const li = e.target.closest('li');
        if(!li || li.textContent === "Menu tidak dikenali") return;

        const productId = li.dataset.productId;
        const productElement = document.getElementById(`product-${productId}`);
        if(productElement) {
            productElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
            clearResults();
            searchInput.value = '';
        }
    });

    // Jika klik di luar hasil pencarian dan input, sembunyikan hasil
    document.addEventListener('click', function(e) {
        if(!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            clearResults();
        }
    });
});