export default {
    install(Vue, options) {

        Vue.VERSION = 'v2.0.3';

        Vue.prototype.$hideModal = function(modalId) {
            $('body').removeClass('modal-open')
            $('.modal-backdrop').remove();
            $('#'+modalId).removeClass('show')
        }
    }
}
