<template>
  <v-app>
    <component :is="layout">
      <router-view/>
    </component>
  </v-app>
</template>

<script>
import LayoutMain from '@/layouts/LayoutMain.vue';

export default {
  name: 'App',
  components: {
    LayoutMain,
  },
  computed: {
    layout() { return `Layout${this.$route.meta.layout || 'Main'}`; },
  },
};
</script>
