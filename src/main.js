import Vue from 'vue';
import App from './App.vue';
import router from './router';
import vuetify from './plugins/vuetify';
import VueMask from './plugins/vmask';

Vue.config.productionTip = false;

new Vue({
  router,
  vuetify,
  VueMask,
  render: (h) => h(App),
}).$mount('#app');
