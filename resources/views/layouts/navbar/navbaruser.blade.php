<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .nav-hidden {
            transform: translateY(-100%);
            transition: transform 0.3s ease-in-out;
        }
        .nav-visible {
            transform: translateY(0);
            transition: transform 0.3s ease-in-out;
        }
        .active {
            background-color: #1E3A8A;
            color: white;
            border-radius: 8px;
            padding: 8px 16px;
        }
    </style>
</head>
<body>
    <nav id="navbar" class="fixed top-0 left-0 right-0 flex items-center justify-between px-8 py-4 bg-gradient-to-r from-white to-blue-100 shadow-md nav-visible">
        <!-- Logo -->
        <div class="text-2xl font-bold text-blue-900">Bisnius</div>
        
        <!-- Navigation Links -->
        <div class="flex space-x-6 text-lg">
            <a href="#" class="nav-link" onclick="setActive(event)">Home</a>
            <a href="/class" class="nav-link" onclick="setActive(event)">Class</a>
            <a href="/mentor" class="nav-link" onclick="setActive(event)">Mentor</a>
        </div>
        
        <!-- Profile Icon -->
        <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-900">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 18.75a8.25 8.25 0 1115 0" />
            </svg>
        </div>
    </nav>

    <script>
        let lastScrollTop = 0;
        const navbar = document.getElementById("navbar");
        const links = document.querySelectorAll(".nav-link");
        
        window.addEventListener("scroll", function() {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollTop > lastScrollTop) {
                navbar.classList.remove("nav-visible");
                navbar.classList.add("nav-hidden");
            } else {
                navbar.classList.remove("nav-hidden");
                navbar.classList.add("nav-visible");
            }
            lastScrollTop = scrollTop;
        });

        function setActive(event) {
            document.querySelectorAll(".nav-link").forEach(link => link.classList.remove("active"));
            event.target.classList.add("active");
        }

        function highlightActiveLink() {
            const currentPath = window.location.pathname;
            links.forEach(link => {
                if (link.getAttribute("href") === currentPath) {
                    link.classList.add("active");
                }
            });
        }
        
        highlightActiveLink();
    </script>
</body>
</html>