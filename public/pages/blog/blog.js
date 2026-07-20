import './blog.scss';
import './../../src-utilities/header';
import './../../src-utilities/footer';
import './../../src-utilities/country';
import { initZohoForm } from '../../src-utilities/formSubmission';

//copy link to clipboard
function fallbackCopyTextToClipboard(text) {
	var textArea = document.createElement('textarea');
	textArea.value = text;

	document.body.appendChild(textArea);
	textArea.select();

	try {
		var successful = document.execCommand('copy');
		var msg = successful ? 'successful' : 'unsuccessful';
	} catch (err) {
		console.error('Oops, unable to copy', err);
	}

	document.body.removeChild(textArea);
}

async function copyTextToClipboard(text) {
	try {
		await navigator.clipboard.writeText(text);
	} catch (err) {
		console.error('Failed to copy text:', err);
	}
}

function showCopyAlert() {
	let copied_text = document.querySelector('.copied_text');
	setTimeout(() => {
		copied_text.style.opacity = 1;
	}, 0);

	setTimeout(() => {
		copied_text.style.opacity = 0;
	}, 2000);
}

let copylink = document.getElementById('copylink');
copylink.addEventListener('click', function (e) {
	let urldata = window.location.href;
	if (!navigator.clipboard) {
		fallbackCopyTextToClipboard(urldata);
		showCopyAlert();
		return;
	}
	copyTextToClipboard(urldata);
	showCopyAlert();
});
//copy link to clipboard



// audio js
const audio = document.getElementById('audio');
const playPauseBtn = document.querySelector('.play-pause-btn');
const muteBtn = document.querySelector('.mute-btn');
const progressBar = document.querySelector('.progress-bar');
const progressBarFill = document.querySelector('.progress-bar-fill');

let isDragging = false;

// SVG Icons
const playIcon = `
<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
  <path d="M12 1C5.925 1 1 5.925 1 12C1 18.075 5.925 23 12 23C18.075 23 23 18.075 23 12C23 5.925 18.075 1 12 1ZM17.183 13.415L10.4505 17.302C10.1945 17.4495 9.914 17.5235 9.6335 17.5235C9.353 17.5235 9.0725 17.4495 8.8165 17.302C8.305 17.0065 7.9995 16.478 7.9995 15.887V8.113C7.9995 7.5225 8.305 6.9935 8.8165 6.698C9.328 6.4025 9.9385 6.4025 10.45 6.698L17.1825 10.585C17.694 10.8805 17.9995 11.409 17.9995 12C17.9995 12.591 17.6945 13.1195 17.183 13.415Z" fill="white"/>
</svg>`;
const pauseIcon = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12 1C5.925 1 1 5.925 1 12C1 18.075 5.925 23 12 23C18.075 23 23 18.075 23 12C23 5.925 18.075 1 12 1ZM11.1665 16C11.1665 16.5515 10.718 17 10.1665 17H8.5C7.9485 17 7.5 16.5515 7.5 16V8C7.5 7.4485 7.9485 7 8.5 7H10.1665C10.718 7 11.1665 7.4485 11.1665 8V16ZM16.5 16C16.5 16.5515 16.0515 17 15.5 17H13.8335C13.282 17 12.8335 16.5515 12.8335 16V8C12.8335 7.4485 13.282 7 13.8335 7H15.5C16.0515 7 16.5 7.4485 16.5 8V16Z" fill="white"/>
</svg>
`;
const muteIcon = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M18.3596 19.3599C18.1026 19.3599 17.8456 19.2609 17.6506 19.0649C17.2606 18.6729 17.2626 18.0399 17.6546 17.6499C19.1666 16.1479 19.9996 14.1419 19.9996 11.9999C19.9996 9.8579 19.1666 7.8519 17.6546 6.3499C17.2626 5.9599 17.2606 5.3279 17.6506 4.9349C18.0396 4.5429 18.6716 4.5409 19.0646 4.9309C20.9576 6.8119 21.9996 9.3219 21.9996 11.9999C21.9996 14.6779 20.9576 17.1879 19.0646 19.0689C18.8696 19.2629 18.6146 19.3599 18.3596 19.3599Z" fill="white"/>
<path d="M15.5296 16.53C15.2716 16.53 15.0136 16.431 14.8186 16.233C14.4296 15.84 14.4336 15.207 14.8266 14.819C15.5716 14.082 15.9996 13.054 15.9996 12C15.9996 10.946 15.5716 9.91798 14.8266 9.18098C14.4336 8.79298 14.4306 8.15998 14.8186 7.76698C15.2066 7.37498 15.8396 7.37098 16.2326 7.75898C17.3556 8.86898 17.9996 10.415 17.9996 12C17.9996 13.585 17.3556 15.131 16.2326 16.241C16.0376 16.434 15.7836 16.53 15.5296 16.53Z" fill="white"/>
<path d="M12 21.9999C11.74 21.9999 11.484 21.8979 11.293 21.7069L6.586 16.9999H4C2.897 16.9999 2 16.1029 2 14.9999V8.99992C2 7.89692 2.897 6.99992 4 6.99992H6.586L11.293 2.29292C11.579 2.00592 12.009 1.92092 12.383 2.07592C12.757 2.23092 13 2.59592 13 2.99992V20.9999C13 21.4039 12.757 21.7689 12.383 21.9239C12.259 21.9749 12.129 21.9999 12 21.9999Z" fill="white"/>
</svg>
`;
const unmuteIcon = `<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_534_429)">
<path d="M12 21.9999C11.74 21.9999 11.484 21.8979 11.293 21.7069L6.586 16.9999H4C2.897 16.9999 2 16.1029 2 14.9999V8.99992C2 7.89692 2.897 6.99992 4 6.99992H6.586L11.293 2.29292C11.579 2.00592 12.009 1.92092 12.383 2.07592C12.757 2.23092 13 2.59592 13 2.99992V20.9999C13 21.4039 12.757 21.7689 12.383 21.9239C12.259 21.9749 12.129 21.9999 12 21.9999Z" fill="white"/>
<path d="M1.13281 3L17.9638 22.0976" stroke="#0100C8" stroke-width="2" stroke-linecap="round"/>
<path d="M1.13281 1L17.9638 20.0976" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
</g>
<defs>
<clipPath id="clip0_534_429">
<rect width="24" height="24" fill="white"/>
</clipPath>
</defs>
</svg>
`;

// Play or Pause the audio
playPauseBtn.addEventListener('click', () => {
	if (audio.paused) {
		audio.play();
		playPauseBtn.innerHTML = pauseIcon;
	} else {
		audio.pause();
		playPauseBtn.innerHTML = playIcon;
	}
});

// Mute or Unmute the audio
muteBtn.addEventListener('click', () => {
	audio.muted = !audio.muted;
	muteBtn.innerHTML = audio.muted ? unmuteIcon : muteIcon;
});

// Update progress bar as the audio plays
audio.addEventListener('timeupdate', () => {
	if (!isDragging) {
		const progressPercent = (audio.currentTime / audio.duration) * 100;
		progressBarFill.style.width = `${progressPercent}%`;
	}
});

// Seek audio position on progress bar click
progressBar.addEventListener('click', (event) => {
	const progressBarWidth = progressBar.offsetWidth;
	const clickX = event.offsetX;
	const newTime = (clickX / progressBarWidth) * audio.duration;
	audio.currentTime = newTime;
});

// Dragging functionality for progress bar
progressBar.addEventListener('mousedown', (event) => {
	isDragging = true;
	updateProgress(event);
});

document.addEventListener('mousemove', (event) => {
	if (isDragging) {
		updateProgress(event);
	}
});

document.addEventListener('mouseup', () => {
	isDragging = false;
});

function updateProgress(event) {
	const progressBarWidth = progressBar.offsetWidth;
	const clickX = event.clientX - progressBar.getBoundingClientRect().left;
	const newTime = Math.max(0, Math.min(clickX / progressBarWidth, 1)) * audio.duration;
	audio.currentTime = newTime;
	progressBarFill.style.width = `${(newTime / audio.duration) * 100}%`;
}
// audio js



// Newsletter CTA Subscribe Form
document.addEventListener('DOMContentLoaded', function () {
	initZohoForm('#cta-subscribe-form', 'gardenbaskethubb-Website-Newsletter', 'success');
});

// Newsletter CTA Subscribe Form