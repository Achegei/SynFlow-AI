import './bootstrap';

import Alpine from 'alpinejs';
import Vapi from "@vapi-ai/web";

window.Alpine = Alpine;

Alpine.start();

window.vapi = new Vapi("80bec441-462a-4a2b-b281-39f377babcf0");