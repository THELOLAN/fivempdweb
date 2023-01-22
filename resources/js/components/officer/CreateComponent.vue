<template>
  <div class="nk-content">
    <div class="card card-bordered card-stretch">
      <div class="card-inner-group">
        <div class="card-inner">
          <div class="container-fluid">
            <div class="nk-content-inner">
              <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                  <div class="nk-block-between">
                    <div class="nk-block-head-content">
                      <h3 class="nk-block-title page-title">Officer</h3>
                      <div class="nk-block-des text-soft">
                        <p>Overview of all registered officers</p>
                      </div>
                    </div>
                    <!-- .nk-block-head-content -->
                    <div class="nk-block-head-content">
                      <div class="toggle-wrap nk-block-tools-toggle">
                        <a
                          href="#"
                          class="btn btn-icon btn-trigger toggle-expand mr-n1"
                          data-target="pageMenu"
                          ><em class="icon ni ni-menu-alt-r"></em
                        ></a>
                        <div
                          class="toggle-expand-content"
                          data-content="pageMenu"
                        >
                          <ul class="nk-block-tools g-3">
                            <li v-can="'user.create'">
                              <router-link
                                :to="{ name: 'user-index' }"
                                href="#"
                                class="btn btn-white btn-outline-light"
                                ><em class="icon ni ni-arrow-left"></em
                                ><span>Back</span></router-link
                              >
                            </li>
                          </ul>
                        </div>
                      </div>
                      <!-- .toggle-wrap -->
                    </div>
                    <!-- .nk-block-head-content -->
                  </div>
                  <!-- .nk-block-between -->
                </div>
                <!-- .nk-block-head -->
                <div class="nk-block">
                  <form @submit.prevent="postData">
                    <div class="form-group row">
                      <label
                        for=""
                        class="control-label col-lg-2 text-right mt-1 required"
                        >Name</label
                      >
                      <div class="col-lg-8">
                        <input
                          type="text"
                          v-model="form.name"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('name') }"
                        />
                        <has-error :form="form" field="name" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for=""
                        class="control-label col-lg-2 text-right mt-1 required"
                        >Username</label
                      >
                      <div class="col-lg-8">
                        <input
                          type="text"
                          v-model="form.username"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('username') }"
                        />
                        <has-error :form="form" field="username" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for=""
                        class="control-label col-lg-2 text-right mt-1 required"
                        >Password</label
                      >
                      <div class="col-lg-8">
                        <input
                          type="password"
                          v-model="form.password"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('password') }"
                        />
                        <has-error :form="form" field="password" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for=""
                        class="control-label col-lg-2 text-right mt-1 required"
                        >Sex</label
                      >
                      <div class="col-lg-8">
                        <select
                          v-model="form.sex"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('sex') }"
                        >
                          <option value="">-- Please select --</option>
                          <option value="m">Male</option>
                          <option value="f">Female</option>
                        </select>
                        <has-error :form="form" field="sex" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <label
                        for=""
                        class="control-label col-lg-2 text-right mt-1 required"
                        >Rank</label
                      >
                      <div class="col-lg-8">
                        <select
                          v-model="form.role"
                          class="form-control"
                          :class="{ 'is-invalid': form.errors.has('role') }"
                        >
                          <option value="">-- Please select --</option>
                          <option
                            :value="role.id"
                            v-for="role in roles"
                            v-bind:key="role.id"
                          >
                            {{ role.name }}
                          </option>
                        </select>
                        <has-error :form="form" field="role" />
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-lg-12 text-center">
                        <button
                          class="btn btn-primary btn-block col-lg-4 text-center"
                        >
                          Submit
                        </button>
                      </div>
                    </div>
                  </form>
                  <!-- .col -->
                </div>
              </div>
              <!-- .nk-block -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      roles: {},
      form: new Form({
        name: "",
        username: "",
        sex: "",
        role: "",
        password: "",
      }),
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      axios.get("/officer/daten").then((response) => {
        this.roles = response.data.roles;
      });
    },
    postData() {
      this.form.post("/officer/speichern").then((response) => {
        this.$noty.success("You have successfully created the officer.");
        this.$router.push({ name: "user-index" });
      });
    },
  },
};
</script>
