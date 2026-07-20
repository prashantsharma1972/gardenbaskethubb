import './success.scss';
import './../../src-utilities/header';
import './../../src-utilities/footer';

var url1 = window.location.href;
var url = new URL(url1);
var msg = url.searchParams.get('msg');

if (url.searchParams.get('emailid')) {
	document.querySelector('.emailid').innerHTML =
		url.searchParams.get('emailid');
}
if (msg == 'webinar') {
	document.querySelector('.textchange').innerHTML =
		"You'll shortly receive the presentation on your mail.";
} else {
	document.querySelector('.textchange').innerHTML =
		'Your request has been received successfully. Our team will contact you soon.';
}
