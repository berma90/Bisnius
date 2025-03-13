<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="frame-src 'self' https://www.youtube.com;">
    <title>Document</title>
</head>
<body>
    <div class="bg-primary50 w-full h-60 flex justify-start items-center">
        <div class="d flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="bg-white ml-24 rounded-full" width="70" height="70" viewBox="0 0 63 64" fill="none">
            <path opacity="0.4" d="M31.5 58.2762C45.9975 58.2762 57.75 46.5237 57.75 32.0262C57.75 17.5288 45.9975 5.77625 31.5 5.77625C17.0025 5.77625 5.25 17.5288 5.25 32.0262C5.25 46.5237 17.0025 58.2762 31.5 58.2762Z" fill="#292D32"/>
            <path d="M31.5 18.7175C26.0663 18.7175 21.6562 23.1275 21.6562 28.5613C21.6562 33.89 25.83 38.2213 31.3687 38.3788C31.4475 38.3788 31.5525 38.3788 31.605 38.3788C31.6575 38.3788 31.7362 38.3788 31.7887 38.3788C31.815 38.3788 31.8413 38.3788 31.8413 38.3788C37.1438 38.195 41.3175 33.89 41.3438 28.5613C41.3438 23.1275 36.9338 18.7175 31.5 18.7175Z" fill="#05415F"/>
            <path d="M49.2975 51.32C44.625 55.625 38.3775 58.2763 31.5 58.2763C24.6225 58.2763 18.375 55.625 13.7025 51.32C14.3325 48.9313 16.0388 46.7525 18.5325 45.0725C25.6988 40.295 37.3538 40.295 44.4675 45.0725C46.9875 46.7525 48.6675 48.9313 49.2975 51.32Z" fill="#05415F"/>
                <a href="/editprof" class="group">
                    <svg x="37" y="38" width="26" class="pen transition-shadow duration-300 group-hover:drop-shadow-[0_10px_10px_rgba(255,252,255,0.5)] shadow-black " height="28" viewBox="0 0 27 28" fill="none">
                        <rect x="0.5" y="0.5" width="26" height="27" rx="13" fill="#D9D9D9"/>
                        <rect x="0.5" y="0.5" width="26" height="27" rx="13" stroke="#05415F"/>
                        <path d="M12.5805 18.3121L17.7575 13.1351C16.8866 12.7713 16.0956 12.24 15.4294 11.5713C14.7604 10.905 14.2289 10.1137 13.8649 9.24252L8.6879 14.4195C8.28402 14.8234 8.08172 15.0257 7.90813 15.2483C7.70331 15.5111 7.52753 15.7953 7.38385 16.096C7.26275 16.3508 7.17245 16.6224 6.99186 17.1641L6.0385 20.0221C5.99462 20.153 5.98811 20.2935 6.0197 20.4279C6.05129 20.5622 6.11973 20.6851 6.21732 20.7827C6.31491 20.8803 6.43779 20.9487 6.57215 20.9803C6.7065 21.0119 6.847 21.0054 6.97786 20.9615L9.83586 20.0081C10.3783 19.8275 10.6492 19.7372 10.904 19.6162C11.2059 19.4724 11.4885 19.2977 11.7517 19.0919C11.9743 18.9183 12.1766 18.716 12.5805 18.3121ZM19.1938 11.6987C19.71 11.1826 20 10.4825 20 9.75246C20 9.02246 19.71 8.32236 19.1938 7.80618C18.6776 7.28999 17.9775 7 17.2475 7C16.5175 7 15.8174 7.28999 15.3013 7.80618L14.6804 8.42705L14.707 8.50475C15.0129 9.38026 15.5136 10.1749 16.1713 10.8287C16.8447 11.5061 17.6671 12.0167 18.5729 12.3196L19.1938 11.6987Z" fill="#05415F"/>
                    </svg>
                </a>
            </svg>
        </div>
        <div class="flex flex-col">

            <p class="flex text-white text-2xl ml-8 mb-1">{{ Auth::user()->name }}</p>
            <p class="flex text-white text-xl ml-8 mb-1">{{ Auth::user()->jurusan }}</p>
        </div>
    </div>

    <div class="flex space-x-6 mx-5 mt-2">
        <a href="{{ route('profilC') }}"
            class="px-4 py-2 rounded-full transition font-medium text-xl
            {{ Route::currentRouteName() == 'profilC' ? 'text-primary50' : 'text-gray-700 hover:text-primary50' }}">
            Class
        </a>
        <a href="{{ route('profilT') }}"
            class="px-4 py-2 rounded-full transition font-medium text-xl
            {{ Route::currentRouteName() == 'profilT' ? 'text-primary50' : 'text-gray-700 hover:text-primary50' }}">
            Transaction
        </a>
        <a href="{{ route('profilA') }}"
            class="px-4 py-2 rounded-full transition font-medium text-xl
            {{ Route::currentRouteName() == 'profilA' ? 'text-primary50' : 'text-gray-700 hover:text-primary50' }}">
            Appreciate
        </a>
    </div>

</body>
</html>
