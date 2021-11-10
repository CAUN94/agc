var map = L.map('mapid').setView([-33.417642958010035, -70.57758338876975], 15);


L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

L.marker([-33.417642958010035, -70.57758338876975]).addTo(map)
    .bindPopup('You Just Better<br>San Pascual 736, Las Condes')
    .openPopup();