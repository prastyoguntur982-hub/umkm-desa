{{-- <div id="cuaca-widget" class="max-w-sm mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden">
    <div class="flex items-center px-6 py-4">
        <div class="text-yellow-400" id="cuaca-icon">
            <!-- Icon Cuaca akan dimasukkan via JS -->
        </div>
        <div class="ml-4 text-left">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white">Cuaca Hari Ini</h3>
            <p class="text-sm text-gray-600 dark:text-gray-300">Tirtomulyo, Kendal</p>
            <p id="cuaca-info" class="text-xl font-semibold text-gray-900 dark:text-gray-100 mt-1">Memuat...</p>
            <p id="cuaca-detail" class="text-xs text-gray-500 dark:text-gray-400">—</p>
        </div>
    </div>
</div>

<script>
    const API_KEY = 'd8d1eeade817efaf2adba58485c715ce'; 
    const lat = -7.1161;  
    const lon = 109.9964;

    fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&units=metric&lang=id&appid=${API_KEY}`)
        .then(res => res.json())
        .then(data => {
            const suhu = Math.round(data.main.temp);
            const cuaca = data.weather[0].description;
            const kelembapan = data.main.humidity;
            const angin = data.wind.speed;
            const iconCode = data.weather[0].icon;
            const iconURL = `https://openweathermap.org/img/wn/${iconCode}@2x.png`;

            document.getElementById('cuaca-info').textContent = `${suhu}°C • ${cuaca.charAt(0).toUpperCase() + cuaca.slice(1)}`;
            document.getElementById('cuaca-detail').textContent = `Kelembapan: ${kelembapan}% | Angin: ${angin} km/jam`;
            document.getElementById('cuaca-icon').innerHTML = `<img src="${iconURL}" alt="${cuaca}" class="w-12 h-12">`;
        })
        .catch(err => {
            document.getElementById('cuaca-info').textContent = 'Gagal memuat data';
            document.getElementById('cuaca-detail').textContent = 'Silakan cek koneksi atau API key.';
        });
</script> --}}
