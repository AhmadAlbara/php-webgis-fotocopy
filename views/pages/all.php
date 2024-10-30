<?php
include '../controllers/LocationController.php';

$lokasiController = new LocationController();
$location = $lokasiController->getAllLocations();

?>


<section class="py-10">
    <div class="flex gap-5">
        <div class="w-[70%]  " id="table">
            <table class="rounded-lg w-full">
                <thead>
                    <tr class="bg-primary text-white uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Location Name</th>
                        <th class="py-3 px-6 text-left">Address</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php foreach ($location as $loc): ?>
                        <tr class="border-b ">
                            <td class="py-3 px-6 text-left"><?= $loc['name']; ?></td>
                            <td class="py-3 px-6 text-left"><?= $loc['address']; ?></td>
                            <td class="py-3 px-6 text-center flex">
                                <a href="./index.php?page=update&id=<?= $loc['id'] ?>" class="text-blue-500 hover:text-blue-700 mx-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="../../routes.php?action=delete&id=<?= $loc['id'] ?>" class="text-red-500 hover:text-red-700 mx-2">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="w-[30%]" id="detail">
            <div id="map" class="!h-[300px] rounded-lg"></div>
        </div>
    </div>
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


    <?php foreach ($location as $loc): ?>
        L.marker([<?php echo $loc['lat']; ?>, <?php echo $loc['lng']; ?>], {
                icon: myIcon
            })
            .addTo(map)
            .bindPopup(`
                <div style="font-family: Arial, sans-serif; max-width: 200px;">
                    <h1 style="margin: 0; color: #2C3E50; font-weight:800">${<?php echo json_encode($loc['name']); ?>}</h1>
                    <p style="margin: 5px 0; color: #34495E;"><strong>Address:</strong> ${<?php echo json_encode($loc['address']); ?>}</p>
                    <p style="margin: 5px 0; color: #34495E;"><strong>Phone:</strong> ${<?php echo json_encode($loc['phone_number']); ?>}</p>
                    <p style="margin: 5px 0; color: #34495E;"><strong>Service:</strong> ${<?php echo json_encode($loc['service_type']); ?>}</p>
                    <p style="margin: 5px 0; color: #34495E;"><strong>Hours:</strong> ${<?php echo json_encode($loc['opening_hours']); ?>}</p>
                </div>
            `);
    <?php endforeach; ?>
</script>