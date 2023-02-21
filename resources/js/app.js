import './bootstrap';
import './switcher';
import './leftslider';
import 'tw-elements';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();
