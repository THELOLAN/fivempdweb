<template>
  <div class="nk-sidebar nk-sidebar-fixed is-dark" data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
      <div class="nk-sidebar-brand">
        <a href="html/index.html" class="logo-link nk-sidebar-logo">
          <img
            class="logo-light logo-img"
            src="https://cdn.discordapp.com/attachments/745411001108791367/859840198299615262/CADPD1.png"
            alt="logo-dark"
          />
        </a>
      </div>
      <div class="nk-menu-trigger mr-n2">
        <a
          href="#"
          class="nk-nav-toggle nk-quick-nav-icon d-xl-none"
          data-target="sidebarMenu"
          ><em class="icon ni ni-arrow-left"></em
        ></a>
      </div>
    </div>
    <!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element">
      <div class="nk-sidebar-content">
        <div class="nk-sidebar-menu" data-simplebar>
          <ul class="nk-menu">
            <router-link :to="{ name: 'index' }" tag="li" class="nk-menu-item">
              <a href="" class="nk-menu-link">
                <span class="nk-menu-icon"
                  ><em class="icon ni ni-dashlite"></em
                ></span>
                <span class="nk-menu-text">Dashboard</span>
              </a> </router-link
            ><!-- .nk-menu-item -->
            <router-link
              :to="{ name: 'civilian-index' }"
              tag="li"
              class="nk-menu-item"
              v-if="civilian"
            >
              <a href="" class="nk-menu-link">
                <span class="nk-menu-icon"
                  ><em class="icon ni ni-users"></em
                ></span>
                <span class="nk-menu-text">Citizen database</span>
              </a> </router-link
            ><!-- .nk-menu-item -->
            <router-link
              :to="{ name: 'vehicle-index' }"
              tag="li"
              class="nk-menu-item"
              v-if="vehicle"
            >
              <a href="" class="nk-menu-link">
                <span class="nk-menu-icon"
                  ><em class="icon ni ni-truck"></em
                ></span>
                <span class="nk-menu-text">Vehicle database</span>
              </a> </router-link
            ><!-- .nk-menu-item -->
            <router-link
              :to="{ name: 'law-index' }"
              tag="li"
              class="nk-menu-item"
              v-if="law_books"
            >
              <a href="" class="nk-menu-link">
                <span class="nk-menu-icon"
                  ><em class="icon ni ni-book"></em
                ></span>
                <span class="nk-menu-text">Law books</span>
              </a> </router-link
            ><!-- .nk-menu-item -->
            <router-link
              :to="{ name: 'penalties-index' }"
              tag="li"
              class="nk-menu-item"
              v-if="law_books"
            >
              <a href="" class="nk-menu-link">
                <span class="nk-menu-icon"
                  ><em class="icon ni ni-book"></em
                ></span>
                <span class="nk-menu-text">Penalty catalog</span>
              </a> </router-link
            ><!-- .nk-menu-item -->
            <router-link
              :to="{ name: 'controlcenter-index' }"
              tag="li"
              class="nk-menu-item"
              v-if="managment_center"
            >
              <a href="" class="nk-menu-link">
                <span class="nk-menu-icon"
                  ><em class="icon ni ni-bell"></em
                ></span>
                <span class="nk-menu-text">Control center</span>
              </a> </router-link
            ><!-- .nk-menu-item -->
            <router-link
              :to="{ name: 'instructions-index' }"
              tag="li"
              class="nk-menu-item"
              v-if="instructions"
            >
              <a href="" class="nk-menu-link">
                <span class="nk-menu-icon"
                  ><em class="icon ni ni-list"></em
                ></span>
                <span class="nk-menu-text">Service instructions</span>
              </a> </router-link
            ><!-- .nk-menu-item -->
            <router-link
              :to="{ name: 'bolo-index' }"
              tag="li"
              class="nk-menu-item"
              v-if="bolo"
            >
              <a href="" class="nk-menu-link">
                <span class="nk-menu-icon"
                  ><em class="icon ni ni-question"></em
                ></span>
                <span class="nk-menu-text">Warrants</span>
              </a> </router-link
            ><!-- .nk-menu-item -->
            <!--<router-link
              :to="{ name: 'investigations-index' }"
              tag="li"
              class="nk-menu-item"
              v-if="investigations"
            >
              <a href="" class="nk-menu-link">
                <span class="nk-menu-icon"
                  ><em class="icon ni ni-monitor"></em
                ></span>
                <span class="nk-menu-text">Investigations</span>
              </a> </router-link
            ><!-- .nk-menu-item -->
            <router-link
              :to="{ name: 'trainings-index' }"
              tag="li"
              class="nk-menu-item"
              v-if="trainings"
            >
              <a href="" class="nk-menu-link">
                <span class="nk-menu-icon"
                  ><em class="icon ni ni-info"></em
                ></span>
                <span class="nk-menu-text">Trainings</span>
              </a> </router-link
            ><!-- .nk-menu-item -->
            <router-link
              :to="{ name: 'user-index' }"
              tag="li"
              class="nk-menu-item"
              v-if="officer"
            >
              <a href="" class="nk-menu-link">
                <span class="nk-menu-icon"
                  ><em class="icon ni ni-user"></em
                ></span>
                <span class="nk-menu-text">Officer</span>
              </a> </router-link
            ><!-- .nk-menu-item -->
            <router-link
              :to="{ name: 'role-index' }"
              tag="li"
              class="nk-menu-item"
              v-if="role"
            >
              <a href="" class="nk-menu-link">
                <span class="nk-menu-icon"
                  ><em class="icon ni ni-setting"></em
                ></span>
                <span class="nk-menu-text">Rank managment</span>
              </a> </router-link
            ><!-- .nk-menu-item -->
            <!-- .nk-menu-item -->
          </ul>
          <!-- .nk-menu -->
        </div>
        <!-- .nk-sidebar-menu -->
      </div>
      <!-- .nk-sidebar-content -->
    </div>
    <!-- .nk-sidebar-element -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      civilian: false,
      vehicle: false,
      law_books: false,
      managment_center: false,
      instructions: false,
      bolo: false,
      investigations: false,
      trainings: false,
      officer: false,
      logs: false,
      role: false,
      user: {},
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      axios.get("/sidebar/daten").then((response) => {
        this.user = response.data.user;
        this.civilian = response.data.civilian_database;
        this.vehicle = response.data.vehicle_database;
        this.law_books = response.data.law_books;
        this.managment_center = response.data.managment_center;
        this.instructions = response.data.instructions;
        this.bolo = response.data.bolo;
        this.investigations = response.data.investigations;
        this.trainings = response.data.trainings;
        this.officer = response.data.officer;
        this.logs = response.data.logs;
        this.role = response.data.role;
      });
    },
  },
};
</script>

<style scoped>
</style>
