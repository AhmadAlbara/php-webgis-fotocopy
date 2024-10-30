<?php
include '../controllers/LocationController.php';

$lokasiController = new LocationController();
$location = $lokasiController->getLocationById($_GET['id']);
?>


<section class="py-10">
    <h1 class="text-xl font-medium mb-4 text-primary">Edit Location Data</h1>
    <div class="flex flex-col lg:flex-row gap-5 w-full">
        <div class="w-full lg:w-[60%]">
            <div id="map"></div>
        </div>
        <div class="w-full lg:w-[40%]">
            <form action="../routes.php?action=update" method="POST">

                <input type="hidden" name="id" value="<?php echo $location['id']; ?>" />
                <input type="text" name="name" placeholder="Photocopy Place Name" class="w-full p-2 border rounded mb-4" value="<?php echo $location['name']; ?>" required>
                <textarea name="address" placeholder="Address" class="w-full p-2 border rounded mb-4" required><?php echo $location['address']; ?></textarea>
                <input type="number" name="phone_number" placeholder="Phone Number" class="w-full p-2 border rounded mb-4" value="<?php echo $location['phone_number']; ?>" required>
                <select name="service_type" class="w-full p-2 border rounded mb-4" required>
                    <option value="">Select Service Type</option>
                    <option value="fotokopi" <?php if ($location['service_type'] == 'fotokopi') echo 'selected'; ?>>Photocopy</option>
                    <option value="print" <?php if ($location['service_type'] == 'print') echo 'selected'; ?>>Printing</option>
                    <option value="jilid" <?php if ($location['service_type'] == 'jilid') echo 'selected'; ?>>Binding</option>
                    <option value="dll" <?php if ($location['service_type'] == 'dll') echo 'selected'; ?>>Others</option>
                </select>
                <input type="text" name="opening_hours" placeholder="Opening Hours (e.g., 08:00-17:00)" class="w-full p-2 border rounded mb-4" value="<?php echo $location['opening_hours']; ?>" required>
                <input type="text" id="inputLat" name="lat" placeholder="Latitude" class="w-full p-2 border rounded mb-4" value="<?php echo $location['lat']; ?>" readonly>
                <input type="text" id="inputLng" name="lng" placeholder="Longitude" class="w-full p-2 border rounded mb-4" value="<?php echo $location['lng']; ?>" readonly>
                <button type="submit" class="w-full bg-primary text-white p-2 rounded">Save</button>
            </form>
        </div>
    </div>
</section>



<script>
    var myIcon = L.icon({
        iconUrl: '../../assets/img/icon.png',
        iconSize: [30, 30],

    });
    const map = L.map('map').setView([<?php echo $location['lat']; ?>, <?php echo $location['lng']; ?>], 12);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    const latInput = document.getElementById("inputLat");
    const lngInput = document.getElementById("inputLng");
    let marker = L.marker([<?php echo $location['lat']; ?>, <?php echo $location['lng']; ?>], {
        icon: myIcon
    }).addTo(map);
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