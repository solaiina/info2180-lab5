<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$country = isset($_GET['country']) ? $_GET['country'] : '';
$stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
$lookup = isset($_GET['lookup']) ? $_GET['lookup'] : '';

if ($lookup == 'cities') {
    $stmt = $conn->query("SELECT c.name, c.district, c.population FROM cities c 
    JOIN countries cs ON c.country_code = cs.code 
  WHERE cs.name LIKE '%$country%'");   
} else {
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");   
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if ($lookup == 'cities'): ?>
  <table id="cities">
    <tr>
    <th>Name</th>
    <th>District</th>
    <th>Population</th>
    </tr>

    <?php foreach ($results as $row): ?>
    <tr>
    <td> <?=$row['name']?> </td>
    <td> <?=$row['district']?> </td>
    <td> <?=$row['population']?> </td>
    </tr>
    <?php endforeach; ?>
  </table>
<?php else: ?>


<table id="countries">
  <tr>
  <th>Country Name</th>
  <th>Continent</th>
  <th>Independence Year</th>
  <th>Head of State</th>
</tr>
<?php foreach ($results as $row): ?>
  <tr>
  <td> <?=$row['name']?> </td>
  <td> <?=$row['continent']?> </td>
  <td> <?=$row['independence_year']?></td>
  <td> <?=$row['head_of_state']?> </td>
</tr>
<?php endforeach; ?>
</table>

<?php endif; ?>
