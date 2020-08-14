# Weather-Station

Aplikasi ini adalah aplikasi pemantauan cuaca di WSN berbasis arduino. Untuk sementara digunakan 2 arduino sebagai node sensor dan 1 arduino sebagai base station
Untuk komunikasi antar node digunakan alat yang bernama XBee.

Langkah-langkah menjalankan program:
1. Nyalakan xampp.
2. Buat database di phpmyadmin dengan mengimport weather_station.sql yang ada di folder Database table.
3. Buka folder Program > Arduino
4. Pasang sensor DHT11(output pada digital pin 5), BMP280(SCL pada analog pin 5,dan SDI pada analog pin 4), dan sensor curah hujan(A0 pada analog pin 0)
	pada arduino node sensor
5. Upload code program sendDataNode1 ke node sensor 1(arduino 1) dan pastikan mengeluarkan nilai pada serial monitor
6. Upload code program sendDataNode2 ke node sensor 2(arduino 2) dan pastikan mengeluarkan nilai pada serial monitor
7. Upload code program ReceiveData ke base station(arduino 3)
8. Pasang XBee pada setiap arduino(node)
9. Pastikan base station menerima data dari setiap node sensor pada serial monitor
10. Masukkan PHP files ke htdocs atau arahkan directory xampp ke PHP files.
11. Buka localhost pada browser dan arahkan ke PHP files.
12. Aplikasi pemantauan cuaca pada WSN berbasis arduino siap digunakan.

Software yang dibutuhkan:
1. Arduino IDE
2. XAMPP

By. M.N.C
