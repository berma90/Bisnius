<div class="flex items-center justify-between mx-2">
    <form method="GET" action="{{ url()->current() }}" class="flex items-center space-x-4 w-full">
        <!-- Search Bar -->
        <div class="relative flex items-center border border-primary50 rounded-full px-4 py-2 bg-gray-100 w-1/2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-primary50" viewBox="0 0 24 24" fill="none">
                <path d="M10 2a8 8 0 016.32 12.906l4.387 4.387a1 1 0 01-1.415 1.415l-4.387-4.387A8 8 0 1110 2zm0 2a6 6 0 100 12 6 6 0 000-12z" fill="currentColor"/>
            </svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search here..."
                class="bg-gray-100 text-lg border-none px-2 focus:ring-0 w-full text-primary50 outline-none">
        </div>

        <!-- Dropdown Filter -->
        <div class="flex items-center space-x-2">
            <div class="text-sm font-bold text-black">Sort By</div>
            <select name="filter" class="border border-primary50 rounded-full px-4 py-2 bg-gray-100 outline-none text-black cursor-pointer"
                onchange="this.form.submit();">
                <option value="">All</option>
                @foreach ($jurusanList as $jurusan)
                    <option value="{{ $jurusan->id }}" {{ request('filter') == $jurusan->id ? 'selected' : '' }}>
                        {{ $jurusan->jurusan }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>
</div>
