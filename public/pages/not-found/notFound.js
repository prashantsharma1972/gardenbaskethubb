import './notFound.scss';
import './../../src-utilities/header';
import './../../src-utilities/footer';

var url1 = window.location.href;
var url = new URL(url1);
var msg = url.searchParams.get('msg');
if (msg == 'webinar') {
	document.querySelector('.textchange').innerHTML =
		"You'll shortly receive the presentation on your mail.";
}
