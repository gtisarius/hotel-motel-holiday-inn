<?php
try {
    require_once __DIR__ . '/db.php';
    $version = $pdo->query('SELECT version()')->fetchColumn();
    $status = "Successfully connected to the database!";
} catch (PDOException $e) {
    error_log($e->getMessage());          // full detail goes to `docker compose logs web`
    $status = "Connection failed.";       // don't show DB errors to visitors
    $version = "N/A";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPP Stack Status</title>
    <style>
        body { font-family: sans-serif; margin: 40px; background: #f4f4f9; color: #333; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); max-width: 600px; }
        h1 { color: #0066cc; }
        .status { font-weight: bold; font-size: 1.1em; }
    </style>
</head>
<body>

    <div class="card">
        <h1>LAPP Stack Environment</h1>
        <p class="status"><?php echo $status; ?></p>
        <p><strong>PHP Version:</strong> <?php echo phpversion(); ?></p>
        <p><strong>Database Software:</strong> <?php echo $version; ?></p>
    </div>

</body>
</html>