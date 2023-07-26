const locationSearchOptions = {
    key: "oc_gs_8jhgsf873gebvjsfhvkshkbghfun44",
    language: 'en'
};

const locationNameField = document.getElementById('locationName');
const locationLatitudeField = document.getElementById('locationLatitude');
const locationLongitudeField = document.getElementById('locationLongitude');

const handleLocationSearchResult = ({ item }) => {
    let locationName = item.formatted;
    let latitude = item.geometry.lat;
    let longitude = item.geometry.lng;

    console.log("locationName: " + locationName);
    console.log("latitude: " + latitude);
    console.log("longitude: " + longitude);

    locationNameField.value = locationName;
    locationLatitudeField.value = latitude;
    locationLongitudeField.value = longitude;

    Livewire.emit('neulyCareGeoSearch', locationName, latitude, longitude);

};

const locationSearchEvents = {
    onSelect: handleLocationSearchResult
};

opencage.algoliaAutocomplete({
    container: "#autocomplete",
    placeholder: "Search for places",
    plugins: [opencage.OpenCageGeoSearchPlugin(locationSearchOptions, locationSearchEvents)]
});

document.querySelector('.aa-ClearButton').addEventListener('click', function() {
    Livewire.emit('clearSearchLocation');
});
