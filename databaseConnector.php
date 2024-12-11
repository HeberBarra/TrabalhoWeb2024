<script src="typescript/redirecionar.ts"></script>
<?php
    $host = getenv("HOST");
    $username = getenv("USER");
    $password = getenv("PASSWORD");
    $database = "bd_SistemaAnimes";

    $connection = new mysqli($host, $username, $password, $database);
