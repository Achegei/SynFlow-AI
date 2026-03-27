import './bootstrap';

import Alpine from 'alpinejs';
import Vapi from "@vapi-ai/web";

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    window.vapi = new Vapi("80bec441-462a-4a2b-b281-39f377babcf0");

   // =========================
// 🎤 VAPI VOICE (FIXED FINAL)
// =========================
const voiceBtnDesktop = document.getElementById('voice-call-btn');
const voiceBtnMobile = document.getElementById('voice-call-btn-mobile');
const modal = document.getElementById('voice-modal');
const closeBtn = document.getElementById('close-voice-modal');

const startBtn = document.getElementById('start-btn');
const stopBtn = document.getElementById('stop-btn');
const status = document.getElementById('status');

function openModal() {
    console.log("OPEN CLICKED");
    modal.classList.remove('hidden');
}

function closeModal() {
    modal.classList.add('hidden');
}

voiceBtnDesktop?.addEventListener('click', openModal);
voiceBtnMobile?.addEventListener('click', openModal);
closeBtn?.addEventListener('click', closeModal);

modal.addEventListener('click', (e) => {
    if (e.target === modal) closeModal();
});

// 🚀 START CALL
startBtn.addEventListener('click', () => {
    status.textContent = "Connecting...";

    window.vapi.start('cae11b05-5a6d-4c7f-bc45-79e25c216a3f');

    startBtn.disabled = true;
    stopBtn.disabled = false;
});

// 🛑 STOP CALL
stopBtn.addEventListener('click', () => {
    window.vapi.stop();

    startBtn.disabled = false;
    stopBtn.disabled = true;

    status.textContent = "Call ended";
});

// 🎧 EVENTS
window.vapi.on('call-start', () => {
    status.textContent = "Call started. Speak now...";
});

window.vapi.on('speech-start', () => {
    status.textContent = "Assistant speaking...";
});

window.vapi.on('speech-end', () => {
    status.textContent = "Listening...";
});

window.vapi.on('call-end', () => {
    status.textContent = "Call ended";
});

window.vapi.on('error', (e) => {
    console.error(e);
    status.textContent = "Error connecting to AI";
});
});