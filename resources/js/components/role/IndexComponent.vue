<template>
  <div class="nk-content">
    <div class="container-fluid">
      <div class="nk-content-inner">
        <div class="nk-content-body">
          <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
              <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Ranks</h3>
                <div class="nk-block-des text-soft">
                  <p>Manage your ranks and permissions</p>
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
                      <li v-can="'role.edit'">
                        <a
                          data-toggle="modal"
                          data-target="#editModal"
                          href="#"
                          class="btn btn-white btn-outline-light"
                          ><em class="icon ni ni-pen"></em
                          ><span>Edit rank</span></a
                        >
                      </li>
                      <li v-can="'role.create'">
                        <a
                          data-toggle="modal"
                          data-target="#createModal"
                          href="#"
                          class="btn btn-white btn-outline-light"
                          ><em class="icon ni ni-plus"></em
                          ><span>Create rank</span></a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- .toggle-wrap -->
              </div>
              <!-- .nk-block-head-content -->
              <!-- .nk-block-head-content -->
            </div>
            <!-- .nk-block-between -->
          </div>
          <!-- .nk-block-head -->
          <div class="nk-block">
            <div class="card card-bordered card-stretch">
              <div class="card-inner-group">
                <div class="card-inner">
                  <div id="accordion-2" class="accordion accordion-s3">
                    <div class="accordion-item" v-for="role in roles">
                      <a
                        href="#"
                        class="accordion-head collapsed"
                        data-toggle="collapse"
                        :data-target="'#accordion-item' + role.id"
                      >
                        <h6 class="title">
                          {{ role.name }}
                          <span class="float-right text-muted">{{
                            role.priority
                          }}</span>
                        </h6>
                        <span class="accordion-icon"></span>
                      </a>
                      <div
                        class="accordion-body collapse"
                        :id="'accordion-item' + role.id"
                        data-parent="#accordion-2"
                      >
                        <div class="accordion-inner">
                          <h5>This rank has the following permissions:</h5>
                          <div>
                            <div class="row">
                              <div
                                class="col-lg-4"
                                v-bind:key="permission.id"
                                v-for="permission in role.permissions"
                              >
                                {{ permission.label }}
                                <a
                                  @click.prevent="
                                    removePermission(role.id, permission.id)
                                  "
                                  v-can="'role.set.permissions'"
                                  href=""
                                  class="ml-1"
                                  ><em class="icon ni ni-trash"></em
                                ></a>
                              </div>
                            </div>
                            <div
                              class="row"
                              v-if="role.permissions.length == 0"
                            >
                              <div
                                class="badge badge-outline-danger badge-sm badge-dim"
                              >
                                This rank has no permissions!
                              </div>
                            </div>
                          </div>
                          <hr />
                          <a
                            href=""
                            class="btn btn-outline-primary mb-2"
                            @click.prevent="checkAll(role.id)"
                            v-can="'role.set.permissions'"
                            >Alle Berechtigungen auswählen</a
                          >
                          <form @submit.prevent="postForm(role.id)" v-can="'role.set.permissions'">
                            <div>
                              <div class="row">
                                <div
                                  class="col-lg-4"
                                  v-bind:key="permission.id"
                                  v-for="permission in permissions"
                                >
                                  <input
                                    type="checkbox"
                                    class="mr-1"
                                    v-model="form.permissions"
                                    :value="permission.id"
                                  />
                                  {{ permission.label }}
                                </div>
                              </div>
                            </div>
                            <div class="btn-group mt-3">
                              <button v-can="'role.set.permissions'"
                                type="submit"
                                href=""
                                class="btn btn-outline-secondary"
                              >
                                Absenden
                              </button>
                              <a @click.prevent="deleteRole(role.id)" href="" class="btn btn-outline-danger" v-can="'role.delete'">Delete</a>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- .card-inner -->
              </div>
              <!-- .card-inner-group -->
            </div>
            <!-- .card -->
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
            <h5 class="modal-title">Edit rank</h5>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger alert-pro d-none" id="errorAlert">
              <em class="icon ni-ni-info"></em>
            </div>
            <div class="form-group">
              <label for="" class="control-label"
                >Please choose a rank!</label
              >
              <select
                v-model="editModal.select"
                @change="editRole"
                class="form-control"
              >
                <option selected disabled value="">
                  -- Please select --
                </option>
                <option
                  :value="role.id"
                  v-bind:key="role.id"
                  v-for="role in allRoles"
                >
                  {{ role.name }}
                </option>
              </select>
            </div>
            <div id="hiddenContent" class="d-none">
              <div class="form-group">
                <label for="">Rank name</label>
                <input
                  type="text"
                  v-model="editModal.name"
                  class="form-control"
                />
              </div>
              <div class="form-group">
                <label for="">Priority</label>
                <input
                  type="text"
                  v-model="editModal.priority"
                  class="form-control"
                />
                <small>1 - highest priority; 100 - lowest priority</small>
              </div>
              <div class="form-group">
                <label for="">Rang verstecken</label>
                <input
                  type="checkbox"
                  :checked="editModal.hidden == 1"
                  v-model="editModal.hidden"
                /><br />
                <small
                  >Should this rank be hidden on the overview page
                  be hidden?</small
                >
              </div>
            </div>
          </div>
          <div class="modal-footer bg-light">
            <button
              id="submitBtn"
              class="btn btn-secondary d-none"
              @click.prevent="updateRole"
            >
              Absenden
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" tabindex="-1" id="createModal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <a href="#" class="close" data-dismiss="modal" aria-label="Close">
            <em class="icon ni ni-cross"></em>
          </a>
          <div class="modal-header">
            <h5 class="modal-title">Create rank</h5>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger alert-pro d-none" id="errorAlert">
              <em class="icon ni-ni-info"></em>
            </div>
            <div class="form-group">
              <label for="">Rank name</label>
              <input
                type="text"
                v-model="createModal.name"
                :class="{ 'is-invalid' : createModal.errors.has('name') }"
                class="form-control"
              />
              <has-error :form="createModal" field="name" />
            </div>
            <div class="form-group">
              <label for="">Priority</label>
              <input
                type="text"
                v-model="createModal.priority"
                :class="{ 'is-invalid' : createModal.errors.has('priority') }"
                class="form-control"
              />
              <small>1 - höchste Priorität; 100 - niedrigste Priorität</small>
              <has-error :form="createModal" field="priority" />
            </div>
            <div class="form-group">
              <label for="">Hide rank</label>
              <input
                type="checkbox"
                v-model="createModal.hidden"
              /><br />
              <small
                >Should this rank be hidden on the overview page
                be hidden?</small
              >
            </div>
          </div>
          <div class="modal-footer bg-light">
            <button
              class="btn btn-secondary"
              @click.prevent="storeRole"
            >
              Submit
            </button>
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
      allSelected: true,
      roles: {},
      allRoles: {},
      permissions: {},
      form: new Form({
        permissions: [],
      }),
      editModal: new Form({
        name: "",
        priority: "",
        hidden: 0,
        select: "",
      }),
      createModal: new Form({
          name: "",
          priority: "",
          hidden: false,
      })
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      axios.get("/rollen/daten").then((response) => {
        this.roles = response.data.roles;
        this.permissions = response.data.permissions;
      });
      axios.get("/rollen/abrufen").then((response) => {
        this.allRoles = response.data.roles;
      });
    },
    postForm(id) {
      this.form.post("/rollen/" + id + "/berechtigungen").then((response) => {
        this.$noty.success(
          "You have successfully updated the permissions of the role."
        );
        this.getData();
        this.form.reset();
      });
    },
    removePermission(role, permission) {
      axios
        .post("/rollen/" + role + "/berechtigung/" + permission + "/entfernen")
        .then((response) => {
          this.$noty.success(
            "You have successfully stripped the rank of its eligibility!"
          );
          this.getData();
        });
    },
    checkAll(role) {
      axios
        .post("/rollen/" + role + "/berechtigungen/zuweisen")
        .then((response) => {
          this.getData();
          this.$noty.success("The rank has been granted all authorizations.");
        });
    },
    editRole() {
      axios
        .get("/rollen/" + this.editModal.select + "/daten")
        .then((response) => {
          if (response.data.success) {
            $("#hiddenContent").removeClass("d-none");
            $("#submitBtn").removeClass("d-none");
            this.editModal.name = response.data.role.name;
            this.editModal.priority = response.data.role.priority;
            this.editModal.hidden = response.data.role.hidden;
          } else {
            $("#errorAlert").removeClass("d-none");
            $("#hiddenContent").addClass("d-none");
            $("#submitBtn").addClass("d-none");
            document.getElementById("errorAlert").innerHTML =
              response.data.error;
          }
        });
    },
    updateRole() {
      this.editModal
        .post("/rollen/" + this.editModal.select + "/aktualisieren")
        .then((response) => {
          this.$noty.success("You have successfully edited the rank.");
          this.$hideModal("editModal");
          this.getData();
        });
    },
    storeRole() {
        this.createModal.post('/rollen/erstellen')
        .then((response) => {
            if (response.data.success) {
                this.$noty.success("You have successfully created the role.")
                this.$hideModal('createModal')
                this.getData()
            } else {
                this.$noty.error("An error has occurred! Please try again!")
            }
        })
    },
    deleteRole(val) {
        axios.post('/rollen/'+val+'/löschen')
            .then((response) => {
                if (response.data.success) {
                    this.$noty.success("You have successfully deleted the role!");
                    this.getData()
                } else {
                    this.$noty.error("An error has occurred! Please try again!")
                }
            })
    }
  },
};
</script>
