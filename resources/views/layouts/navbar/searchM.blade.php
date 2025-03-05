<div class="flex items-center space-x-40 mx-2 place-content-between">
    <!-- Search Bar -->
    <div class="relative flex items-center border border-primary50 rounded-full px-3 py-1 bg-gray-100">
        <svg xmlns="http://www.w3.org/2000/svg" width="53" height="46" class="w-10 h-10" viewBox="0 0 53 50" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M24.1708 0.913696C21.1777 0.913951 18.2279 1.63 15.5677 3.0021C12.9076 4.37421 10.6141 6.36258 8.87866 8.80132C7.14323 11.2401 6.01616 14.0585 5.5915 17.0214C5.16683 19.9843 5.45688 23.0058 6.43744 25.8338C7.41801 28.6618 9.06065 31.2144 11.2283 33.2784C13.396 35.3425 16.0259 36.8582 18.8985 37.6992C21.7711 38.5402 24.8032 38.682 27.7418 38.1129C30.6803 37.5437 33.4402 36.2801 35.7911 34.4274L43.8559 42.4922C44.2724 42.8945 44.8303 43.117 45.4093 43.112C45.9883 43.107 46.5422 42.8747 46.9516 42.4653C47.3611 42.0559 47.5933 41.502 47.5983 40.923C47.6034 40.3439 47.3808 39.7861 46.9785 39.3696L38.9137 31.3048C41.0955 28.5369 42.454 25.2107 42.8337 21.7068C43.2134 18.2028 42.5989 14.6628 41.0607 11.4918C39.5224 8.32081 37.1225 5.64694 34.1355 3.77621C31.1486 1.90547 27.6953 0.91346 24.1708 0.913696ZM9.81668 19.6845C9.81668 15.8776 11.329 12.2265 14.0209 9.5346C16.7128 6.84267 20.3639 5.33036 24.1708 5.33036C27.9778 5.33036 31.6288 6.84267 34.3208 9.5346C37.0127 12.2265 38.525 15.8776 38.525 19.6845C38.525 23.4915 37.0127 27.1425 34.3208 29.8345C31.6288 32.5264 27.9778 34.0387 24.1708 34.0387C20.3639 34.0387 16.7128 32.5264 14.0209 29.8345C11.329 27.1425 9.81668 23.4915 9.81668 19.6845Z" fill="#05415F"/>
            </svg>
        <input type="text" placeholder="search in here" class="bg-gray-100 text-lg border-none px-2 focus:ring-0 w-full text-primary50">
    </div>

    <div class="flex space-x-6 justify-items-end">
    <!-- Dropdown Sort By -->
    <div class="flex flex-col text-sm ">
        <span class="font-bold text-black">Sort</span>
        <span class="text-black font-semibold">By</span>
    </div>
    <div>
        <form method="GET" id="filterForm">
            <select name="filter" class="border border-primary50 rounded-full px-4 py-2 bg-gray-100 outline-none text-black"
                onchange="document.getElementById('filterForm').action = this.value; document.getElementById('filterForm').submit();">
                <option value="/mentor" {{ request()->is('mentor') ? 'selected' : '' }}>All</option>
                <option value="/mentorjur" {{ request()->is('mentorjur') ? 'selected' : '' }}>Teknik Jaringan Komputer</option>
            </select>
        </form>
        
        
        
        
        

    </div>
</div>