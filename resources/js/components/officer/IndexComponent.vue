<template>
  <div class="nk-content">
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
                  <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                      <li v-can="'user.create'">
                        <router-link
                          :to="{ name: 'user-create' }"
                          href="#"
                          class="btn btn-white btn-outline-light"
                          ><em class="icon ni ni-plus"></em
                          ><span>Create officer</span></router-link
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
            <div class="row g-gs">
              <div
                class="col-sm-6 col-lg-4 col-xxl-3"
                v-bind:key="user.id"
                v-for="user in users"
              >
                <div class="card card-bordered">
                  <div class="card-inner">
                    <div class="team">
                      <div class="team-options" v-can="'user.manage'">
                        <div class="drodown">
                          <a
                            href="#"
                            class="dropdown-toggle btn btn-sm btn-icon btn-trigger"
                            data-toggle="dropdown"
                            ><em class="icon ni ni-more-h"></em
                          ></a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <ul class="link-list-opt no-bdr">
                              <li>
                                <a
                                  @click.prevent="
                                    setValues(
                                      user.name,
                                      user.username,
                                      user.sex,
                                      user.roles[0].id,
                                      user.slug
                                    )
                                  "
                                  data-toggle="modal"
                                  data-target="#editModal"
                                  href="#"
                                  ><em class="icon ni ni-pen"></em
                                  ><span>Edit officer</span></a
                                >
                              </li>
                              <li>
                                <a
                                  @click.prevent="deleteUser(user.slug)"
                                  href="#"
                                  ><em class="icon ni ni-trash"></em
                                  ><span>Delete officer</span></a
                                >
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="user-card user-card-s2">
                        <div class="user-avatar md bg-primary">
                          <span>{{ user.name.charAt(0) }}</span>
                          <div
                            class="status dot dot-lg dot-success"
                            v-if="user.status == 'on_duty'"
                          ></div>
                          <div
                            class="status dot dot-lg dot-danger"
                            v-else
                          ></div>
                        </div>
                        <div class="user-info">
                          <h6>{{ user.name }}</h6>
                          <span class="sub-text">{{ user.roles[0].name }}</span>
                        </div>
                      </div>
                      <ul class="team-statistics">
                        <li>
                          <span>{{ user.civilian_entries.length }}</span
                          ><span>File entries</span>
                        </li>
                        <li>
                          <span>{{ user.investigations.length }}</span
                          ><span>Investigations</span>
                        </li>
                        <!--<li><span>587</span><span>Tasks</span></li>-->
                      </ul>
                    </div>
                    <!-- .team -->
                  </div>
                  <!-- .card-inner -->
                </div>
                <!-- .card -->
              </div>
              <!-- .col -->
            </div>
          </div>
          <!-- .nk-block -->
        </div>
      </div>
    </div>
    <div class="modal fade" tabindex="-1" id="editModal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <a href="#" class="close" data-dismiss="modal" aria-label="Close">
            <em class="icon ni ni-cross"></em>
          </a>
          <div class="modal-header">
            <h5 class="modal-title">Edit{{ form.name }}</h5>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="" class="control-label col-lg-2 text-right mt-1"
                >Name</label
              >
              <div class="col-lg-10">
                <input type="text" v-model="form.name" class="form-control" />
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="control-label col-lg-2 text-right mt-1"
                >Username</label
              >
              <div class="col-lg-10">
                <input
                  type="text"
                  v-model="form.username"
                  class="form-control"
                />
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="control-label col-lg-2 text-right mt-1"
                >Sex</label
              >
              <div class="col-lg-10">
                <select v-model="form.sex" class="form-control">
                  <option :selected="form.sex == 'm'" value="m">
                    Male
                  </option>
                  <option :selected="form.sex == 'f'" value="f">
                    Female
                  </option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="control-label col-lg-2 text-right mt-1"
                >Rank</label
              >
              <div class="col-lg-10">
                <select v-model="form.role" class="form-control">
                  <option
                    :selected="form.role === role.id"
                    :value="role.id"
                    v-for="role in roles"
                    v-bind:key="role.id"
                  >
                    {{ role.name }}
                  </option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer bg-light">
            <a
              href=""
              class="btn btn-primary text-right"
              @click.prevent="editUser(form.id)"
              >Submit</a
            >
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
      users: {},
      roles: {},
      form: new Form({
        name: "",
        username: "",
        sex: "",
        role: "",
        id: "",
      }),
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      axios.get("/officer/daten").then((response) => {
        this.users = response.data.users;
        this.roles = response.data.roles;
      });
    },
    deleteUser(id) {
      axios.post("/officer/" + id + "/löschen").then((response) => {
        this.getData();
        this.$noty.success("You have successfully deleted the officer");
      });
    },
    setValues(name, username, sex, role, id) {
      this.form.name = name;
      this.form.username = username;
      this.form.sex = sex;
      this.form.role = role;
      this.form.id = id;
    },
    editUser(id) {
      this.form.post("/officer/" + id + "/aktualisieren").then((response) => {
        this.$noty.success("You have successfully edited the officer");
        this.form.reset();
        this.$hideModal("editModal");
        this.getData();
      });
    },
  },
};
</script>
