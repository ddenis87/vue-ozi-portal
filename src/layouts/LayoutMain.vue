<template>
  <div class="layout-main">
    <div class="layout-main__bar">
    </div>
    <div class="layout-main__nav">
      <app-nav></app-nav>
    </div>
    <div class="layout-main__content">
      <router-view/>
    </div>
  </div>
</template>

<script>
import AppNav from '@/components/App/AppNav.vue';

export default {
  name: 'LayoutMain',
  components: {
    AppNav,
  },
};
</script>

<style lang="scss" scoped>
.layout-main {
  display: grid;
  grid-template-areas: "layout-main__bar layout-main__bar"
                       "layout-main__nav layout-main__content";
  grid-template-columns: 200px 1fr;
  grid-template-rows: 36px 1fr;
  min-height: 100%;
  width: 100%;
  &__bar {
    grid-area: layout-main__bar;
    display: flex;
    align-items: center;
    border-bottom: thin solid rgba(0, 0, 0, .6);
    overflow: hidden;
  }
  &__nav {
    grid-area: layout-main__nav;
    display: flex;
    // align-items: center;
    border-right: thin solid rgba(0, 0, 0, .6);
    overflow: hidden;
  }

  &__content {
    grid-area: layout-main__content;
    padding: 5px;
    height: 100%;
    overflow: hidden;
  }
}
</style>
