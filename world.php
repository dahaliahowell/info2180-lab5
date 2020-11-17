<?php header('Access-Control-Allow-Origin: *'); 
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  $check = False;
  $country = $_GET['country'];

  $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
  
  if ($_GET['context'] === 'cities') {

    $check = True;
    $stmt = $conn->query("SELECT c.id, c.name, c.country_code, c.district, c.population, co.name as country, co.code FROM cities c JOIN countries co ON c.country_code=co.code WHERE co.name = '$country'");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  } else {
    
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

  }


}


?>
<?php if ($check === True): ?>
  <?php if (empty($results)): ?>
    <h2>NO RESULTS</h2>
  <?php else: ?>
  <table>
  <tr>
    <th>Name</th>
    <th>District</th>
    <th>Population</th>
  </tr>
<?php foreach ($results as $row): ?>
  <tr>
    <td><?= $row['name']; ?></td>
    <td><?= $row['district']; ?></td>
    <td><?= $row['population']; ?></td>
  </tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
<?php else: ?>
<table>
  <tr>
    <th>Name</th>
    <th>Continent</th>
    <th>Independence</th>
    <th>Head of State</th>
  </tr>
<?php foreach ($results as $row): ?>
  <tr>
    <td><?= $row['name']; ?></td>
    <td><?= $row['continent']; ?></td>
    <td><?= $row['independence_year']; ?></td>
    <td><?= $row['head_of_state']; ?></td>
  </tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
