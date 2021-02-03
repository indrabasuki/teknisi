<h1>Data Map</h1>
<div class="row">
    <div class="col-md-8 ml-auto" id="mapid"></div>
    <div class="col-md-4 bg-dark">
        <div class="list-group" id="data">

        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        map()
        list();

        function list() {
            $.ajax({
                type: 'ajax',
                url: base_url + 'teknisi/get_list',
                async: true,
                dataType: 'json',
                success: function(data) {
                    var i;
                    var html;
                    for (i = 0; i < data.length; i++) {
                        html += `<a href="#" class="list-group-item list-group-item-action" onclick="mapDetail(${data[i].id})">
                            ${data[i].nama} </a>`;
                    }
                    $('#data').html(html);
                }
            });
        }

        function map() {
            $.ajax({
                type: 'ajax',
                url: base_url + 'teknisi/get_data',
                async: true,
                dataType: 'json',
                success: function(data) {
                    var i;
                    var html;
                    for (i = 0; i < data.length; i++) {
                        L.marker([data[i].lat, data[i].lon]).addTo(mymap);
                    }
                }
            });
            var mymap = L.map('mapid').setView([-6.2868, 106.9072], 10);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 20,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoiaW5kcmFiYXN1a2kiLCJhIjoiY2trbnRpZGpsMmU3djMycGRiZm51NmcyYSJ9.1C4JFEjzTJmWisDFBHQIGg'
            }).addTo(mymap);
        }
    });
</script>