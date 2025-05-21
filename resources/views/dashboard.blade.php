<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>VolunteerNet Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <nav class="bg-[#002B5B] text-white px-6 py-4 flex justify-between items-center shadow-md">
    <div class="flex items-center space-x-2">
      <h1 class="text-xl font-bold">VolunteerNet</h1>
    </div>
    <ul class="hidden md:flex space-x-6 font-medium">
      <li><a href="#" class="hover:underline">Home</a></li>
      <li><a href="#" class="hover:underline">My Event</a></li>
      <li><a href="#" class="hover:underline">Community</a></li>
    </ul>
    <img src="https://img.a.transfermarkt.technology/portrait/big/371998-1664869583.jpg?lm=1" class="w-10 h-10 rounded-full border-2 border-white" alt="Profile" />
  </nav>

  <div class="flex min-h-screen">
    <aside class="w-60 bg-[#0B2447] text-white flex flex-col space-y-6 p-6">
      <div>
        <p class="text-sm font-semibold mb-4">Mode</p>
        <div class="flex items-center space-x-3">
          <span class="text-white font-medium">Volunteer</span>
          <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" class="sr-only peer" onchange="toggleMode(this)">
            <div class="w-11 h-6 bg-gray-400 peer-focus:outline-none rounded-full peer peer-checked:bg-[#576CBC] transition-all duration-300"></div>
            <div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-transform duration-300 peer-checked:translate-x-5"></div>
          </label>
          <span class="text-white font-medium">EO</span>
        </div>
      </div>

      <div id="volunteerMenu">
        <button class="text-left font-semibold bg-[#19376D] py-3 px-4 rounded hover:bg-[#576CBC]">Search Event</button>
        <button class="text-left font-semibold bg-[#19376D] py-3 px-4 rounded hover:bg-[#576CBC]">Build Portfolio</button>
        <button class="text-left font-semibold bg-[#19376D] py-3 px-4 rounded hover:bg-[#576CBC]">Activities</button>
        <button class="text-left font-semibold bg-[#19376D] py-3 px-4 rounded hover:bg-[#576CBC]">Notification</button>
      </div>

      <div id="eoMenu" class="hidden">
        <button class="text-left font-semibold bg-[#19376D] py-3 px-4 rounded hover:bg-[#576CBC]">Create Event</button>
        <button class="text-left font-semibold bg-[#19376D] py-3 px-4 rounded hover:bg-[#576CBC]">Manage Volunteer</button>
        <button class="text-left font-semibold bg-[#19376D] py-3 px-4 rounded hover:bg-[#576CBC]">Manage Event</button>
        <button class="text-left font-semibold bg-[#19376D] py-3 px-4 rounded hover:bg-[#576CBC]">Notification</button>
      </div>
    </aside>

    <main class="flex-1 p-10">
<!-- Dashboardnya Volunteer -->
      <div id="volunteerDashboard">
        <h2 class="text-2xl font-bold mb-6 text-[#002B5B]">Volunteer Events</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          
          <div class="bg-white rounded-xl shadow p-6 flex flex-col justify-between">
            <img src="https://persib-app-production.s3.ap-southeast-1.amazonaws.com/liga1_vs_persija_2024_c087f63672.jpg" alt="Match Day Organizer" class="w-full h-40 object-contain mb-4">
            <div>
              <h3 class="text-xl font-bold text-[#0B2447] mb-2">Match Day Organizer Assistant</h3>
              <p class="text-sm text-gray-600 mb-1">📍 Stadion Si Jalak Harupat, Bandung</p>
              <p class="text-sm text-gray-600 mb-4">🗓️ 18 April 2025</p>
            </div>
            <div class="mt-auto flex gap-2">
              <button class="w-full bg-gray-200 text-[#0B2447] font-semibold py-2 px-4 rounded hover:bg-gray-300 transition">Detail</button>
              <button class="w-full bg-[#19376D] text-white py-2 px-4 rounded hover:bg-[#576CBC] transition">Apply</button>
            </div>
          </div>

          <div class="bg-white rounded-xl shadow p-6 flex flex-col justify-between">
            <img src="https://seputaraceh.id/wp-content/uploads/2023/09/e1cff8a9-03ae-44a6-bed4-986eca6830d6-_x600.jpeg" alt="Ball Boy Volunteer" class="w-full h-40 object-contain mb-4">
            <div>
              <h3 class="text-xl font-bold text-[#0B2447] mb-2">Ball Boy Volunteer</h3>
              <p class="text-sm text-gray-600 mb-1">📍 Stadion Gelora Bung Tomo, Surabaya</p>
              <p class="text-sm text-gray-600 mb-4">🗓️ 22 April 2025</p>
            </div>
            <div class="mt-auto flex gap-2">
              <button class="w-full bg-gray-200 text-[#0B2447] font-semibold py-2 px-4 rounded hover:bg-gray-300 transition">Detail</button>
              <button class="w-full bg-[#19376D] text-white py-2 px-4 rounded hover:bg-[#576CBC] transition">Apply</button>
            </div>
          </div>
          
          <div class="bg-white rounded-xl shadow p-6 flex flex-col justify-between">
            <img src="https://pbs.twimg.com/media/Gm2fdvqa8AAruYJ?format=jpg&name=large" alt="Stadium Media Crew" class="w-full h-40 object-contain mb-4">
            <div>
              <h3 class="text-xl font-bold text-[#0B2447] mb-2">Stadium Media Crew</h3>
              <p class="text-sm text-gray-600 mb-1">📍 Stadion Gelora Bung Karno</p>
              <p class="text-sm text-gray-600 mb-4">🗓️ 06 Juni 2025</p>
            </div>
            <div class="mt-auto flex gap-2">
              <button class="w-full bg-gray-200 text-[#0B2447] font-semibold py-2 px-4 rounded hover:bg-gray-300 transition">Detail</button>
              <button class="w-full bg-[#19376D] text-white py-2 px-4 rounded hover:bg-[#576CBC] transition">Apply</button>
            </div>
          </div>
        </div>
      </div>

<!-- Dashboardnya EO -->
<div id="eoDashboard" class="hidden">
  <h2 class="text-2xl font-bold mb-4 text-[#002B5B]">Welcome back, Organizer!</h2>
  <p class="mb-6 text-gray-600">Plan, Manage, and Track Your Social Impact Events with Ease!</p>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <div class="bg-white rounded-lg shadow p-4 text-center font-semibold">18 Upcoming Events</div>
    <div class="bg-white rounded-lg shadow p-4 text-center font-semibold">12+ Registered Volunteers</div>
    <div class="bg-white rounded-lg shadow p-4 text-center font-semibold">03% Engagement Rate</div>
  </div>

  <div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
      
      <div class="bg-white rounded-xl shadow p-6 flex flex-col justify-between">
        <img src="https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/72/2025/03/26/WhatsApp-Image-2025-03-26-at-175907-3801901328.jpeg" alt="Seleksi STY Academy" class="w-full h-40 object-cover mb-4">
        <div>
          <h3 class="text-xl font-bold text-[#0B2447] mb-2">Koreo Indonesia vs China</h3>
          <p class="text-sm text-gray-600 mb-1">📍 Gelora Bung Karno</p>
          <p class="text-sm text-gray-600 mb-4">🗓️ 6 Juni 2025</p>
        </div>
        <div class="mt-auto flex justify-between items-center">
          <span class="text-sm px-3 py-1 bg-green-100 text-green-800 font-medium rounded-full">Active</span>
          <button class="bg-[#19376D] text-white py-2 px-4 rounded hover:bg-[#576CBC] transition">Manage</button>
        </div>
      </div>

      <div class="bg-white rounded-xl shadow p-6 flex flex-col justify-between">
        <img src="https://img.sportcorner.id/uploads/2024/11/15/la_grande_indonesia_ca00203a7e.jpg" alt="Seleksi STY Academy" class="w-full h-40 object-cover mb-4">
        <div>
          <h3 class="text-xl font-bold text-[#0B2447] mb-2">Media La Grande</h3>
          <p class="text-sm text-gray-600 mb-1">📍 Gelora Bung Karno</p>
          <p class="text-sm text-gray-600 mb-4">🗓️ 6 Juni 2025</p>
        </div>
        <div class="mt-auto flex justify-between items-center">
          <span class="text-sm px-3 py-1 bg-green-100 text-green-800 font-medium rounded-full">Active</span>
          <button class="bg-[#19376D] text-white py-2 px-4 rounded hover:bg-[#576CBC] transition">Manage</button>
        </div>
      </div>

    </div>
  </div>
</div>


  <script>
    function toggleMode(el) {
      const isEO = el.checked;
      const volunteerDashboard = document.getElementById("volunteerDashboard");
      const eoDashboard = document.getElementById("eoDashboard");
      const volunteerMenu = document.getElementById("volunteerMenu");
      const eoMenu = document.getElementById("eoMenu");

      if (isEO) {
        volunteerDashboard.classList.add("hidden");
        volunteerMenu.classList.add("hidden");
        eoDashboard.classList.remove("hidden");
        eoMenu.classList.remove("hidden");
      } else {
        volunteerDashboard.classList.remove("hidden");
        volunteerMenu.classList.remove("hidden");
        eoDashboard.classList.add("hidden");
        eoMenu.classList.add("hidden");
      }
    }
  </script>
</body>
</html>
