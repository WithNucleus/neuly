import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

import $ from "jquery";

try {
    window.Popper = require('@popperjs/core');
    require('bootstrap');
} catch (e) {
    console.log(e);
}

import './color-modes';

let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});

/* Confirm */
let confirmationButtons = document.querySelectorAll('.confirm-action');

confirmationButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        if (confirm("Are you sure?") !== true) {
            event.preventDefault();
        }
    });
});

/* CSRF Token Ajax */
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

/* Toast Notifications */
window.addEventListener('toast-notification', event => {
    let time = 4000;

    if(window.innerWidth < 768) {
        time = 2000;
    }

    let backgroundColor = 'bg-quaternary';

    if (event.detail.background) {
        backgroundColor =  event.detail.background;
    }

    let textColor = 'text-white';

    if (event.detail.color) {
        textColor =  event.detail.color;
    }

    let toastContainer = document.querySelector('#toast-container');

    let toastElement = document.createElement('div');
    toastElement.classList.add('toast', 'show', backgroundColor, textColor, 'border-0');

    let toastBody = document.createElement('div');
    toastBody.classList.add('toast-body', 'd-flex');

    let toastText = document.createElement('span');
    toastText.innerText = event.detail.text;

    let closeButton = document.createElement('button');
    closeButton.classList.add('btn-close', 'btn-close-white', 'me-2', 'm-auto');
    closeButton.ariaLabel = 'Close';
    closeButton.setAttribute('data-bs-dismiss', 'toast');

    toastContainer.appendChild(toastElement);
    toastElement.appendChild(toastBody);
    toastBody.appendChild(toastText);
    toastBody.appendChild(closeButton);

    setTimeout(() => {
        toastElement.remove();
    }, time);
});

window.addEventListener('redirect-to-url', event => {
    location.href = event.detail.url;
});

window.addEventListener('redirect-to-url-delay', event => {
    setTimeout(function() {
        location.href = event.detail.url;
    }, 1500);
});
