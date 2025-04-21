<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Aktivitas Saya - VolunteerNet</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
  <!-- Navbar -->
  <nav class="bg-[#002B5B] text-white px-6 py-4 flex justify-between items-center shadow-md">
    <div class="flex items-center space-x-2">
      <h1 class="text-xl font-bold">VolunteerNet</h1>
    </div>
    <ul class="hidden md:flex space-x-6 font-medium">
    <li><a href="{{ route('dashboard') }}" class="hover:underline">Home</a></li>
      <li><a href="#" class="hover:underline">My Event</a></li>
      <li><a href="#" class="hover:underline">Community</a></li>
      <li><a href="#" class="hover:underline">Reward</a></li>
    </ul>
    <img src="https://img.a.transfermarkt.technology/portrait/big/371998-1664869583.jpg?lm=1" class="w-10 h-10 rounded-full border-2 border-white" alt="Profile" />
  </nav>

  <div class="flex min-h-screen">
    <!-- Sidebar -->
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
        <a href="#" class="text-left font-semibold bg-[#19376D] py-3 px-4 rounded hover:bg-[#576CBC] block">Search Event</a>
        <a href="#" class="text-left font-semibold bg-[#19376D] py-3 px-4 rounded hover:bg-[#576CBC] block">Build Portfolio</a>
        <a href="{{ route('activities.index') }}" class="text-left font-semibold bg-[#19376D] py-3 px-4 rounded hover:bg-[#576CBC] block">Activities</a>
        <a href="#" class="text-left font-semibold bg-[#19376D] py-3 px-4 rounded hover:bg-[#576CBC] block">Notification</a>
      </div>

      <div id="eoMenu" class="hidden">
        <a href="#" class="text-left font-semibold bg-[#19376D] py-3 px-4 rounded hover:bg-[#576CBC] block">Create Event</a>
        <a href="#" class="text-left font-semibold bg-[#19376D] py-3 px-4 rounded hover:bg-[#576CBC] block">Manage Volunteer</a>
        <a href="#" class="text-left font-semibold bg-[#19376D] py-3 px-4 rounded hover:bg-[#576CBC] block">Manage Event</a>
        <a href="{{ route('activities.index') }}" class="text-left font-semibold bg-[#19376D] py-3 px-4 rounded hover:bg-[#576CBC] block">Activities</a>
        <a href="#" class="text-left font-semibold bg-[#19376D] py-3 px-4 rounded hover:bg-[#576CBC] block">Notification</a>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10">
      <h2 class="text-2xl font-bold mb-6 text-[#002B5B]">My Activities</h2>
      
      @if(count($activities) === 0)
  <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded" role="alert">
      <p>Belum ada aktivitas yang tercatat.</p>
  </div>
@endif

      @if(count($activities) > 0)
        <ul class="space-y-4">
            @foreach($activities as $activity)
              <li class="bg-white shadow-md p-4 rounded-lg">
                  <div class="flex justify-between items-center">
                      <div>
                          <p class="font-semibold text-[#0B2447]">{{ $activity->action }}</p>
                          <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($activity->date)->format('d M Y, H:i') }}</p>
                      </div>
                  </div>
              </li>
            @endforeach
        </ul>
      @endif
    </main>
  </div>

  <script>
    function toggleMode(el) {
      const isEO = el.checked;
      const volunteerDashboard = document.getElementById("volunteerDashboard");
      const eoDashboard = document.getElementById("eoDashboard");
      const volunteerMenu = document.getElementById("volunteerMenu");
      const eoMenu = document.getElementById("eoMenu");

      if (isEO) {
        if (volunteerDashboard) volunteerDashboard.classList.add("hidden");
        if (volunteerMenu) volunteerMenu.classList.add("hidden");
        if (eoDashboard) eoDashboard.classList.remove("hidden");
        if (eoMenu) eoMenu.classList.remove("hidden");
      } else {
        if (volunteerDashboard) volunteerDashboard.classList.remove("hidden");
        if (volunteerMenu) volunteerMenu.classList.remove("hidden");
        if (eoDashboard) eoDashboard.classList.add("hidden");
        if (eoMenu) eoMenu.classList.add("hidden");
      }
    }
  </script>
</body>
</html>
