import './contactUs.scss';
import './../../src-utilities/header';
import './../../src-utilities/footer';
import './../../src-utilities/country';

import { initZohoForm } from '../../src-utilities/formSubmission';

document.addEventListener('DOMContentLoaded', function () {
    initZohoForm('#needform', 'gardenbaskethubb-ContactUs', 'success');
});
