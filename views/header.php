<style>
    .menu-enter {
        transform: translateX(-100%);
        opacity: 0;
    }

    .menu-enter-active {
        transition: transform 0.3s ease, opacity 0.3s ease;
        transform: translateX(0);
        opacity: 1;
    }

    .menu-exit {
        transform: translateX(0);
        opacity: 1;
    }

    .menu-exit-active {
        transition: transform 0.3s ease, opacity 0.3s ease;
        transform: translateX(-100%);
        opacity: 0;
    }

    /* Styles for the search form animation */
    .search-form {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        background-color: white;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        opacity: 0;
        border-radius: 10px;
        transform: translateY(-10px);
        transition: transform 0.3s ease, opacity 0.3s ease;
        z-index: 1;
    }

    /* Responsive Mobile */
    @media (max-width: 768px) {
        .search-form {
            top: 100%; /* Đẩy form xuống ngay dưới header/menu trên mobile */
        }
    }

    .search-form.active {
        opacity: 1;
        transform: translateY(0);
    }

    i {
        padding: 10px;
    }

    .search-form input {
        border: none;
        background-color: transparent;
        font-size: 1rem;
    }

    .search-form input::placeholder {
        color: #6b7280; /* Placeholder màu xám */
    }

    .search-form input:focus {
        outline: none;
        box-shadow: none;
    }
</style>
<script>
    function toggleMenu() {
        const menu = document.getElementById("mobileMenu");
        if (menu.classList.contains("hidden")) {
            menu.classList.remove("hidden", "menu-exit-active");
            menu.classList.add("menu-enter", "menu-enter-active");
            setTimeout(() => {
                menu.classList.remove("menu-enter", "menu-enter-active");
            }, 300);
        } else {
            menu.classList.add("menu-exit", "menu-exit-active");
            setTimeout(() => {
                menu.classList.add("hidden");
                menu.classList.remove("menu-exit", "menu-exit-active");
            }, 300);
        }
    }

    function toggleSearchForm() {
        const searchForm = document.getElementById("searchForm");
        searchForm.classList.toggle("active");
    }

    window.onclick = function (event) {
        const menu = document.getElementById("mobileMenu");
        const button = document.getElementById("menuButton");
        const searchForm = document.getElementById("searchForm");
        const searchButton = document.getElementById("searchButton");

        if (!menu.contains(event.target) && !button.contains(event.target)) {
            menu.classList.add("menu-exit", "menu-exit-active");
            setTimeout(() => {
                menu.classList.add("hidden");
                menu.classList.remove("menu-exit", "menu-exit-active");
            }, 300);
        }
        if (
            !searchForm.contains(event.target) &&
            !searchButton.contains(event.target)
        ) {
            searchForm.classList.remove("active");
        }
    };
</script>
<header class="bg-gray-100 font-sans">
    <!-- Top Bar with Contact Info (Hidden on mobile) -->
    <div class="bg-blue-500 text-white text-sm">
        <div
                class="container mx-auto hidden md:flex items-center justify-between py-2 px-4"
        >
            <!-- Address and Contact Information (Hidden on small screens) -->
            <div class="flex items-center space-x-2">
          <span class="flex items-center">
            <i class="fa-solid fa-location-dot"></i>
            Tầng 2, Tòa nhà Detech Tower, Số 8 Tôn Thất Thuyết, Quận Nam Từ
            Liêm, Hà Nội
          </span>
                <span class="flex items-center">
            <i class="fa-solid fa-envelope"></i>
            contact@vinaoffice.com.vn
          </span>
                <span class="flex items-center">
            <i class="fa-solid fa-phone"></i>
            0389 323 228
          </span>
            </div>
            <!-- Language Selection Flags -->
            <div class="flex space-x-2">
                <img
                        src="../public/image/vietnam.webp"
                        alt="Vietnam Flag"
                        class="h-5 w-7"
                />
                <img src="../public/image/usa.png" alt="UK Flag" class="h-5 w-7"/>
                <img src="../public/image/japan.webp" alt="Korea Flag" class="h-5 w-7"/>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <div class="bg-white shadow">
        <div
                class="container mx-auto flex items-center justify-between py-4 px-4 relative"
        >
            <!-- Hamburger Icon for Mobile -->
            <button
                    id="menuButton"
                    onclick="toggleMenu()"
                    class="md:hidden focus:outline-none"
            >
                <i class="fa-solid fa-bars"></i>
            </button>
            <!-- Logo -->
            <a href="#" class="flex items-center space-x-2">
                <img src="../public/image/logo.webp" alt="Vina Office Logo" class="h-20"/>
            </a>

            <!-- Navigation Links -->
            <nav
                    class="hidden md:flex space-x-6 text-blue-800 text-sm font-semibold"
            >
                <a href="#" class="hover:text-blue-600">VĂN PHÒNG ẢO</a>
                <a href="#" class="hover:text-blue-600">CHỖ NGỒI LÀM VIỆC</a>
                <a href="#" class="hover:text-blue-600">CHO THUÊ VĂN PHÒNG</a>
                <a href="#" class="hover:text-blue-600">THÀNH LẬP CÔNG TY</a>
                <a href="#" class="hover:text-blue-600">DỊCH VỤ KẾ TOÁN</a>
                <a href="#" class="hover:text-blue-600">LIÊN HỆ</a>
            </nav>

            <!-- Search Button for All Screens -->
            <button
                    id="searchButton"
                    onclick="toggleSearchForm()"
                    class="flex items-center text-blue-800 hover:text-blue-600 z-50"
            >
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

            <!-- Search Form (Hidden initially) -->
            <div
                    id="searchForm"
                    class="search-form absolute top-full left-0 right-0 px-4 py-4"
            >
                <div class="container m-auto">
                    <input
                            type="text"
                            placeholder="Tìm kiếm"
                            class="w-full bg-transparent placeholder-gray-500 p-6 focus:outline-none focus:ring-0"
                    />
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <nav
            id="mobileMenu"
            class="fixed inset-y-0 left-0 w-3/4 bg-white text-blue-800 shadow-md py-3 px-4 menu-enter z-50 hidden"
    >
        <ul class="space-y-4 text-sm font-semibold">
            <li><a href="#" class="block hover:underline">VĂN PHÒNG ẢO</a></li>
            <li><a href="#" class="block hover:underline">CHỖ NGỒI LÀM VIỆC</a></li>
            <li>
                <a href="#" class="block hover:underline">CHO THUÊ VĂN PHÒNG</a>
            </li>
            <li><a href="#" class="block hover:underline">THÀNH LẬP CÔNG TY</a></li>
            <li><a href="#" class="block hover:underline">DỊCH VỤ KẾ TOÁN</a></li>
            <li><a href="#" class="block hover:underline">LIÊN HỆ</a></li>
        </ul>
    </nav>
</header>