<?php
include '../config/Database.php';

class LocationController
{
    public function getAllLocations()
    {
        global $conn;
        $query = "SELECT 
        id,
        name,
        address,
        phone_number,
        service_type,
        opening_hours,
        ST_X(coordinate) AS lat, 
        ST_Y(coordinate) AS lng 
        FROM fotocopy_map";
        return mysqli_query($conn, $query);
    }

    public function getLocationById($id)
    {
        global $conn;
        $id = intval($id); 

        $query = "SELECT id, name, address, phone_number, service_type, opening_hours, ST_X(coordinate) AS lat, ST_Y(coordinate) AS lng FROM fotocopy_map WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result); 
        } else {
            return null; 
        }
    }
    public function addLocation($name, $address, $phone_number, $service_type, $opening_hours, $lat, $lng)
    {
        global $conn;
        $query = "INSERT INTO fotocopy_map (name, address, phone_number, service_type, opening_hours, coordinate) 
              VALUES ('$name', '$address', '$phone_number', '$service_type', '$opening_hours', ST_GeomFromText('POINT($lat $lng)', 4326))";

        mysqli_query($conn, $query);
        header('Location: ../views/index.php?page=dashboard');
        exit();
    }

    public function updateLocation($id, $name, $address, $phone_number, $service_type, $opening_hours, $lat, $lng)
    {
        global $conn;
        $query = "UPDATE fotocopy_map SET 
              name = '$name', 
              address = '$address', 
              phone_number = '$phone_number', 
              service_type = '$service_type', 
              opening_hours = '$opening_hours', 
              coordinate = ST_GeomFromText('POINT($lat $lng)', 4326) 
              WHERE id = $id";
        mysqli_query($conn, $query);
        header('Location: ../views/index.php?page=all');
        exit();
    }


    public function deleteLocation($id)
    {
        global $conn;
        $query = "DELETE FROM fotocopy_map WHERE id=$id";
        mysqli_query($conn, $query);
        header('Location: ../views/index.php?page=all');
        exit();
    }
}
