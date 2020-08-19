mapboxgl.accessToken = 'pk.eyJ1IjoibHV1Y2FzZzA2IiwiYSI6ImNrOTR1MGUxZjA0NzIzbXMwZ3ZqM2o2aGwifQ.HBmfEegS3-Q_OwB1QVksFw';

let map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/mapbox/streets-v11',
center:[2.294481,48.858372],
zoom:15
})

let element=document.createElement('div')
element.className='marker'

let marker=new mapboxgl.Marker(element).setLnglat({
lng:6.2369568,
lat:-75.5597698
})
.addTo(map);

var marker = L.marker([51.5, -0.09]).addTo(map);