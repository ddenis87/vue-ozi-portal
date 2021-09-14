<template>
  <div class="app-nav">
    <v-navigation-drawer permanent>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="text-h6">
            Меню
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>
      <v-list dense
              nav>
        <v-list-item v-for="item in menuList"
                     :key="item.title"
                     tag="router-link"
                     dense
                     :to="item.route">
          <v-list-item-content>
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </div>
</template>

<script>
export default {
  name: 'AppNav',
  data() {
    return {
      menuList: [
        { title: 'Форма для заявления УКЭП', route: '/FormCertificate' },
      ],
    };
  },
};
</script>
