<section class="py-10">
    <h1 class="text-xl font-medium mb-4 text-primary">Add Location</h1>
    <div class="flex flex-col lg:flex-row gap-5 w-full">
        <div class="w-full lg:w-[60%] ">
            <div id="map" class="rounded-lg"></div>
        </div>
        <div class="w-full lg:w-[40%]">
            <form action="../routes.php?action=add" method="POST">
                <input type="hidden" name="id" />
                <input type="text" name="name" placeholder="Name of the Copy Shop" class="w-full p-2 border rounded mb-4" required>
                <textarea name="address" placeholder="Address" class="w-full p-2 border rounded mb-4" required></textarea>
                <input type="number" name="phone_number" placeholder="Phone Number" class="w-full p-2 border rounded mb-4" required>
                <select name="service_type" class="w-full p-2 border rounded mb-4" required>
                    <option value="">Select Service Type</option>
                    <option value="fotokopi">Copying</option>
                    <option value="print">Printing</option>
                    <option value="jilid">Binding</option>
                    <option value="dll">Others</option>
                </select>
                <input type="text" name="opening_hours" placeholder="Opening Hours (e.g., 08:00-17:00)" class="w-full p-2 border rounded mb-4" required>
                <input type="text" id="inputLat" name="lat" placeholder="Latitude" class="w-full p-2 border rounded mb-4" readonly>
                <input type="text" id="inputLng" name="lng" placeholder="Longitude" class="w-full p-2 border rounded mb-4" readonly>
                <button type="submit" class="w-full bg-primary text-white p-2 rounded">Submit</button>
            </form>
        </div>
    </div>
</section>

<script>
    var myIcon = L.icon({
        iconUrl: '../../assets/img/icon.png',
        iconSize: [30, 30],
    });
    var map = L.map('map').setView([-0.05915931509586441, 109.35164314500946], 15);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    const latInput = document.getElementById("inputLat");
    const lngInput = document.getElementById("inputLng");

    let marker;
    map.on('click', function(e) {
        const {
            lat,
            lng
        } = e.latlng;
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker([lat, lng], {
            icon: myIcon
        }).addTo(map);
        latInput.value = lat.toFixed(6);
        lngInput.value = lng.toFixed(6);
    });
</script>