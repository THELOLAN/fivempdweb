/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from "vue";

require('./bootstrap');
window.Vue = require('vue');
window.VueMultiselect = Multiselect
window.numeral = require('numeral');
import { Form, HasError, AlertError } from 'vform'
import VueRouter from 'vue-router'
import moment from 'moment';
import Multiselect from "vue-multiselect";
import VueI18n from 'vue-i18n';
import messages from './lang/lang.js'
import VueNoty from 'vuejs-noty'
import 'vuejs-noty/dist/vuejs-noty.css'
import 'vue-multiselect/dist/vue-multiselect.min.css'
import Editor from '@tinymce/tinymce-vue'
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import NightstudiosModal from './nightstudios/hide-modal.js';
import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs';
Vue.use(LaravelPermissionToVueJS);
window.Form = Form;
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.css';
import VueNumerals from 'vue-numerals';

Vue.use(Loading);
Vue.use(VueRouter);
Vue.use(VueI18n);
Vue.use(NightstudiosModal);
Vue.use(VueNoty, {
    theme: 'sunset',
    timeout: 4000,
});
Vue.use(VueNumerals);
Vue.use(require('vue-moment'));


export const i18n = new VueI18n({
    locale: 'de',
    fallbackLocale: 'de',
    messages,
});


import Index from './components/IndexComponent'

import CivilianIndex from './components/civilian/IndexComponent'
import CivilianShow from './components/civilian/ShowComponent'
import CivilianEntryCreate from './components/civilian/CivilianEntryCreate'

// Einstellungen Komponenten
import Settings from './components/settings/IndexComponent'
import GeneralSettings from './components/settings/GeneralComponent'
import DatabaseSettings from './components/settings/DatabaseComponent'
import SiteSettings from './components/settings/SiteComponent'
import ServerSettings from './components/settings/ServerComponent'

import VehicleIndex from './components/vehicle/IndexComponent'

// Gesetzes Komponenten
import LawIndex from './components/law/IndexComponent'
import LawCreate from './components/law/CreateComponent'
import LawEdit from './components/law/EditComponent'

// Leitstelle Komponenten
import ControlCenterIndex from './components/controlcenter/IndexComponent'
import ControlCenterCreate from './components/controlcenter/CreateComponent'

// Strafkatalog Komponenten
import PenaltiesIndex from './components/penalties/IndexComponent'
import PenaltiesCreate from './components/penalties/CreateComponent'
import PenaltiesEdit  from './components/penalties/EditComponent'

// Dienstanweisungen Komponenten
import InstructionsIndex from './components/instructions/IndexComponent'
import InstructionsCreate from './components/instructions/CreateComponent'
import InstructionsEdit from './components/instructions/EditComponent'

import BoloIndex from './components/bolo/IndexComponent'

import InvestigationsIndex from './components/investigations/IndexComponent'
import InvestigationsShow from './components/investigations/ShowComponent'
import InvestigationsCreate from './components/investigations/CreateComponent'

import TrainingsIndex from './components/trainings/IndexComponent'
import TrainingsShow from './components/trainings/ShowComponent'
import TrainingsCreate from './components/trainings/CreateComponent'
import TrainingsEdit from './components/trainings/EditComponent'

import UserIndex from './components/officer/IndexComponent'
import UserCreate from './components/officer/CreateComponent'

import RoleIndex from './components/role/IndexComponent'

import Password from './components/PasswordComponent'

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'index',
            component: Index,
        },
        {
            path: '/einwohnerdatenbank',
            name: 'civilian-index',
            component: CivilianIndex
        },
        {
            path: '/einwohnerdatenbank/:identifier',
            name: 'civilian-show',
            component: CivilianShow
        },
        {
            path: '/einwohnerdatenbank/:identifier/akteneintrag/erstellen',
            name: 'civilian-create-entry',
            component: CivilianEntryCreate
        },
        {
            path: '/einstellungen',
            name: 'settings',
            component: Settings,
        },
        {
            path: '/einstellungen/allgemein',
            name: 'settings-general',
            component: GeneralSettings,
        },
        {
            path: '/einstellungen/datenbank',
            name: 'settings-database',
            component: DatabaseSettings,
        },
        {
            path: '/einstellungen/seiten',
            name: 'settings-sites',
            component: SiteSettings,
        },
        {
            path: '/einstellungen/server',
            name: 'settings-server',
            component: ServerSettings,
        },
        {
            path: '/fahrzeugdatenbank',
            name: 'vehicle-index',
            component: VehicleIndex
        },
        {
            path: '/gesetze',
            name: 'law-index',
            component: LawIndex
        },
        {
            path: '/gesetze/erstellen',
            name: 'law-create',
            component: LawCreate
        },
        {
            path: '/gesetze/:identifier/bearbeiten',
            name: 'law-edit',
            component: LawEdit
        },
        {
            path: '/leitstelle',
            name: 'controlcenter-index',
            component: ControlCenterIndex
        },
        {
            path: '/strafkatalog',
            name: 'penalties-index',
            component: PenaltiesIndex
        },
        {
            path: '/strafkatalog/erstellen',
            name: 'penalties-create',
            component: PenaltiesCreate
        },
        {
            path: '/strafkatalog/:id/bearbeiten',
            name: 'penalties-edit',
            component: PenaltiesEdit
        },
        {
            path: '/dienstanweisungen',
            name: 'instructions-index',
            component: InstructionsIndex
        },
        {
            path: '/dienstanweisungen/erstellen',
            name: 'instructions-create',
            component: InstructionsCreate
        },
        {
            path: '/dienstanweisungen/:id/bearbeiten',
            name: 'instructions-edit',
            component: InstructionsEdit
        },
        {
            path: '/fahndungen',
            name: 'bolo-index',
            component: BoloIndex
        },
        {
            path: '/ermittlungen',
            name: 'investigations-index',
            component: InvestigationsIndex
        },
        {
            path: '/ermittlung/erstellen',
            name: 'investigations-create',
            component: InvestigationsCreate
        },
        {
            path: '/ermittlungen/:id/einsehen',
            name: 'investigations-show',
            component: InvestigationsShow
        },
        {
            path: '/ausbildungen',
            name: 'trainings-index',
            component: TrainingsIndex,
        },
        {
            path: '/ausbildung/erstellen',
            name: 'trainings-create',
            component: TrainingsCreate
        },
        {
            path: '/ausbildungen/:slug/anschauen',
            name: 'trainings-show',
            component: TrainingsShow
        },
        {
            path: '/ausbildungen/:slug/bearbeiten',
            name: 'trainings-edit',
            component: TrainingsEdit
        },
        {
            path: '/officer',
            name: 'user-index',
            component: UserIndex
        },
        {
            path: '/officer/erstellen',
            name: 'user-create',
            component: UserCreate
        },
        {
            path: '/rollen',
            name: 'role-index',
            component: RoleIndex
        },
        {
            path: '/passwort',
            name: 'password',
            component: Password
        },
        {
            path: '/leitstelle/erstellen',
            name: 'controlcenter-create',
            component: ControlCenterCreate
        }
    ]
})
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('sidebar', require('./components/SidebarComponent').default);
Vue.component('header-component', require('./components/HeaderComponent').default);
Vue.component('footer-component', require('./components/FooterComponent').default)
Vue.component('pagination', require('laravel-vue-pagination/src/LaravelVuePagination').default);
Vue.component('introduction', require('./components/IntroductionComponent').default)
Vue.component('multiselect', Multiselect);
Vue.component("v-select", vSelect);
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('editor', Editor)
import Select2 from 'v-select2-component';

Vue.component('Select2', Select2);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    i18n,
    component: {
        'editor': Editor,
    },
});


Vue.filter("formatNumber", function (value) {
    return numeral(value).format("0,0"); // displaying other groupings/separators is possible, look at the docs
});
Vue.filter('formatDate', function (value) {
    if (value) {
        moment.locale('de')
        return moment(String(value)).format('DD.MM.YYYY HH:mm')
    }
});

Vue.filter('dateCalendar', function (value) {
    if (value) {
        moment.locale('de')
        return moment('calendar', String(value))
    }
})

Vue.directive('can', function (el, binding, vnode) {
    //     axios.get('/permission/'+binding.value)
    //         .then((response) => {
    //             if (!response.data.success) {
    //                 return el.remove();
    //             }
    //         })

    if (Laravel.permissions.indexOf(binding.value) !== -1) {
        return vnode.elm.hidden = false;
    } else {
        return vnode.elm.hidden = true;
    }
})

Vue.prototype.$canRole = function (role ,value) {

};

Vue.prototype.$can = function (value) {
    if (Laravel.permissions.indexOf(value) !== -1) {
        return false;
    } else {
        return true;
    }
}
