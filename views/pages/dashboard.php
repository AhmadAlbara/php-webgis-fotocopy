 <?php
    include '../controllers/LocationController.php';

    $lokasiController = new LocationController();
    $locations = $lokasiController->getAllLocations();
    ?>

 <section class="py-10 ">
     <h1 class="text-xl font-medium mb-4 text-gray-700">Welcome back <i class="text-primary underline">
             <?= $_SESSION['username']; ?>
         </i></h1>
     <div id="map" class="!h-[90vh] -z-[100px] rounded-lg"></div>
 </section>




 <script>
     var myIcon = L.icon({
         iconUrl: '../../assets/img/icon.png',
         iconSize: [30, 30],

     });
     var map = L.map('map').setView([-0.05915931509586441, 109.35164314500946], 12);
     L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
         maxZoom: 19,
         attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
     }).addTo(map);


     <?php foreach ($locations as $location): ?>
         L.marker([<?php echo $location['lat']; ?>, <?php echo $location['lng']; ?>], {
                 icon: myIcon
             })
             .addTo(map)
             .bindPopup(`
                <div style="font-family: Arial, sans-serif; max-width: 200px;">
                    <h1 style="margin: 0; color: #2C3E50; font-weight:800">${<?php echo json_encode($location['name']); ?>}</h1>
                    <p style="margin: 5px 0; color: #34495E;"><strong>Address:</strong> ${<?php echo json_encode($location['address']); ?>}</p>
                    <p style="margin: 5px 0; color: #34495E;"><strong>Phone:</strong> ${<?php echo json_encode($location['phone_number']); ?>}</p>
                    <p style="margin: 5px 0; color: #34495E;"><strong>Service:</strong> ${<?php echo json_encode($location['service_type']); ?>}</p>
                    <p style="margin: 5px 0; color: #34495E;"><strong>Hours:</strong> ${<?php echo json_encode($location['opening_hours']); ?>}</p>
                </div>
            `);
     <?php endforeach; ?>
 </script>