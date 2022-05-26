const pageUrl = document.getElementById('practitioners-page').getAttribute('data-page-url');

const locationSearchOptions = {
    key: "oc_gs_8jhgsf873gebvjsfhvkshkbghfun44",
    language: 'en'
};

const locationNameField = document.getElementById('locationName');
const locationLatitudeField = document.getElementById('locationLatitude');
const locationLongitudeField = document.getElementById('locationLongitude');

const bookableListElement = document.getElementById('bookable-list');
const loadingResult = document.getElementById('loading-results');
const errorResult = document.getElementById('error-results');

const virtualCheckbox = document.getElementById('virtual');

const handleLocationSearchResult = ({ item }) => {
    let locationName = item.formatted;
    let latitude = item.geometry.lat;
    let longitude = item.geometry.lng;

    locationNameField.value = locationName;
    locationLatitudeField.value = latitude;
    locationLongitudeField.value = longitude;

    setLoadingThenGetFilters();
};

const locationSearchEvents = {
    onSelect: handleLocationSearchResult
};

opencage.algoliaAutocomplete({
    container: "#autocomplete",
    placeholder: "Search for places",
    plugins: [opencage.OpenCageGeoSearchPlugin(locationSearchOptions, locationSearchEvents)]
});

function geoFindMe() {

    const status = document.getElementById('location-search-status');

    setLoading();

    function success(position) {
        const latitude  = position.coords.latitude;
        const longitude = position.coords.longitude;

        locationLatitudeField.value = latitude;
        locationLongitudeField.value = longitude;

        getFiltersAndRefine();
    }

    function error() {
        status.textContent = '';
        loadingResult.style.display = "none";
        errorResult.style.display = "block";
        bookableListElement.style.display = "flex";
    }

    if(!navigator.geolocation) {
        status.textContent = 'Geolocation is not supported by your browser';
    } else {
        status.textContent = 'Searching your location...';
        navigator.geolocation.getCurrentPosition(success, error);
    }

}

document.getElementById('find-me').addEventListener('click', geoFindMe);

document.getElementById('filter-distance').addEventListener('change', setLoadingThenGetFilters);

document.querySelectorAll('.filter-type').forEach((filter) => {
    filter.addEventListener('change', setLoadingThenGetFilters);
});

document.getElementById('reset-filters').addEventListener('click', function() {
    window.location = pageUrl;
});

document.getElementById('hide-no-location').addEventListener('click', function() {
    errorResult.style.display = "none";
});

virtualCheckbox.addEventListener('change', setLoadingThenGetFilters);

function setLoading() {
    bookableListElement.style.display = "none";
    loadingResult.style.display = "block";
}

function setLoadingThenGetFilters() {
    setLoading();
    getFiltersAndRefine();
}

function getFiltersAndRefine() {

    let url = pageUrl;

    errorResult.style.display = "none";

    // Get Types
    let filterTypes = [];
    document.querySelectorAll('.filter-type:checked').forEach((filter) => {
        filterTypes.push(filter.value)
    });

    // Get Lat & Long
    let latitude = locationLatitudeField.value;
    let longitude = locationLongitudeField.value;

    if (latitude !== '' && longitude !== '') {
        url = url + '?latitude=' + latitude + '&longitude=' + longitude;
        url = url + '&distance=' + document.getElementById('filter-distance').value + '&';
    } else {
        url = url + '?';
    }

    if (filterTypes.length > 0) {
        url = url + 'filter[type]=' + filterTypes.join("|");
    }

    // Virtual?
    let virtualChecked = virtualCheckbox.checked;

    if (virtualChecked === true) {
        url = url + '&filter[virtual]=1';
    }

    window.location = url;
}
