new PDO("mysql:host=localhost", "root", "",
  array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  );
);