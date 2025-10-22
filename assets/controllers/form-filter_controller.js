import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

    connect() {
        const departement = document.querySelector('#departement');
        console.log(departement);
    }
}