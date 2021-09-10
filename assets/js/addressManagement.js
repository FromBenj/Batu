export function addressAutocomplete(containerElement, inputElement) {

    let number = document.getElementById('service_housenumber');
    let street = document.getElementById('service_street');
    let postcode = document.getElementById('service_postcode');
    let city = document.getElementById('service_city');
    let country = document.getElementById('service_country');
    let county = document.getElementById('service_county');
    let latitude = document.getElementById('service_latitude');
    let longitude = document.getElementById('service_longitude');

    if(!containerElement || !inputElement) {
        return false;
    }

    let isChild = false;
    containerElement.childNodes.forEach(
        element => {
            if (element.id === "service_address") {
                isChild = true;
            }
        }
    )
    if (!isChild) {
        return false;
    }

    /* Active request promise reject function. To be able to cancel the promise when a new request comes */
    let currentPromiseReject;

    function findAddress() {
        removeValues([number, street, postcode, city, country, county, latitude, longitude]);
        closeDropDownList();
        let currentValue = this.value;
        // Cancel previous request promise
        if (currentPromiseReject) {
            currentPromiseReject({
                canceled: true
            });
        }
        if (!currentValue) {
            return false;
        }
        /* Current autocomplete items data (GeoJSON.Feature) */
        let currentItems;

        /* Create a new promise and send geocoding request */
        let promise = new Promise((resolve, reject) => {
            currentPromiseReject = reject;
            const apiKey = geoapifyApiKey;
            const url = `https://api.geoapify.com/v1/geocode/autocomplete?text=${encodeURIComponent(currentValue)}&limit=5&filter=fr&apiKey=${apiKey}`;
            fetch(url)
            .then(response => {
                // check if the call was successful
                if (response.ok) {
                    response.json().then(data => resolve(data));
                    console.log('call successful')
                } else {
                    response.json().then(data => reject(data));
                    console.log('call failed')
                }
            });
        });
        promise.then((data) => {
            currentItems = data.features;
            /*create a DIV element that will contain the items (values):*/
            let autocompleteItemsElement = document.createElement("div");
            autocompleteItemsElement.setAttribute("id", "address-autocomplete-items");
            containerElement.appendChild(autocompleteItemsElement);
            /* For each item in the results */
            currentItems.forEach((feature) => {
                /* Create a DIV element for each element: */
                let itemElement = document.createElement("div");
                /* Set formatted address as item value */
                itemElement.innerHTML = feature.properties.formatted;
                autocompleteItemsElement.appendChild(itemElement);
                itemElement.addEventListener('click', () => {
                    this.value = itemElement.innerHTML;
                    number.value = parseInt(feature.properties.housenumber);
                    street.value = feature.properties.street;
                    postcode.value = parseInt(feature.properties.postcode);
                    city.value = feature.properties.city;
                    country.value = feature.properties.country;
                    county.value = feature.properties.county;
                    latitude.value = parseFloat(feature.properties.lat);
                    longitude.value = parseFloat(feature.properties.lon);
                    closeDropDownList()
                })
            });
        }, (err) => {
            if (!err.canceled) {
                console.log(err);
            }
        });
    }

    function closeDropDownList() {
        const autocompleteItemsElement = containerElement.querySelector("#address-autocomplete-items");
        if (autocompleteItemsElement) {
            containerElement.removeChild(autocompleteItemsElement);
        }
    }

    function removeValues(inputs) {
        inputs.forEach((input) => {
            input.value='';
        })
    }

    
    inputElement.addEventListener("input", findAddress);
    inputElement.addEventListener("keydown", findAddress);
}
