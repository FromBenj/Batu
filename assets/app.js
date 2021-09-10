/*
 * Welcome to your app's main JavaScript file!
 */
import './styles/app.scss';

//Bootstrap
require('bootstrap');

//leaflet
require('leaflet');
import {servicesMap} from './js/servicesMap';
servicesMap();

//Address Autocomplete
import {addressAutocomplete} from "./js/addressManagement";
const addressContainer = document.getElementById("address-container")
const addressInput = document.getElementById("service_address")
addressAutocomplete(addressContainer, addressInput);

//Viewport management
import {viewportManagement} from "./js/allowedViewport";
viewportManagement();
