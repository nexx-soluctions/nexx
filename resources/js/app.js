import './bootstrap';

// const modules = import.meta.glob([
//     './library/*.js',
// ])

// console.log(modules)

import "/node_modules/flag-icons/css/flag-icons.min.css";
import 'vendor/livewire/livewire/dist/livewire.esm.js';

import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import Clipboard from '@ryangjchandler/alpine-clipboard'
 
Alpine.plugin(Clipboard)
 
Livewire.start()

import.meta.glob([
    '../images/**',
    '../fonts/**',
]);
