<template>
  <div class="nk-content">
    <div class="container-fluid">
      <div class="nk-content-inner">
        <div class="nk-content-body">
          <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between g-3">
              <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                  Training /
                  <strong class="text-primary small">{{
                    training.title
                  }}</strong>
                </h3>
                <div class="nk-block-des text-soft">
                  <ul class="list-inline">
                    <li>
                      Referenznummer:
                      <span class="text-base">{{ training.reference }}</span>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="nk-block-head-content">
                <router-link
                  :to="{ name: 'trainings-index' }"
                  href="#"
                  class="btn btn-outline-light bg-white d-none d-sm-inline-flex"
                  ><em class="icon ni ni-arrow-left"></em
                  ><span>Back</span></router-link
                >
                <a
                  @click.prevent="applyTraining(training.slug)"
                  href=""
                  class="btn btn-primary d-none d-sm-inline flex"
                  v-if="training.status == 'active'"
                  >Participate in training</a
                >
                <a
                  @click.prevent="toggleStatus(training.slug)"
                  href=""
                  class="btn btn-danger d-none d-sm-inline-flex"
                  v-can="'trainings.manage'"
                  v-if="training.status == 'active'"
                  >Close training</a
                >
                <a
                  @click.prevent="toggleStatus(training.slug)"
                  href=""
                  class="btn btn-success d-none d-sm-inline-flex"
                  v-can="'trainings.manage'"
                  v-else
                  >Open training</a
                >
              </div>
            </div>
          </div>
          <!-- .nk-block-head -->
          <div class="nk-block">
            <div class="row gy-5">
              <div class="col-lg-12">
                <div class="nk-block-head">
                  <div class="nk-block-head-content">
                    <h5 class="nk-block-title title">
                      Education - Information
                    </h5>
                    <p>Important information regarding training.</p>
                  </div>
                </div>
                <!-- .nk-block-head -->
                <div class="card card-bordered">
                  <ul class="data-list is-compact">
                    <li class="data-item">
                      <div class="data-col">
                        <div class="data-label">Status</div>
                        <div class="data-value">
                          <span
                            class="badge badge-dim badge-sm badge-outline-success"
                            v-if="training.status == 'active'"
                            >Open</span
                          >
                          <span
                            class="badge badge-dim badge-sm badge-outline-danger"
                            v-else
                            >Closed</span
                          >
                        </div>
                      </div>
                    </li>
                    <li class="data-item">
                      <div class="data-col">
                        <div class="data-label">Ausbilder</div>
                        <div class="data-value">
                          <div class="user-card">
                            <div
                              class="user-avatar user-avatar-xs bg-orange-dim"
                            >
                              <span>{{
                                training.user.name.charAt(0) +
                                training.user.name.charAt(1)
                              }}</span>
                            </div>
                            <div class="user-name">
                              <span class="tb-lead">{{
                                training.user.name
                              }}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="data-item">
                      <div class="data-col">
                        <div class="data-label">Ausbildung erstellt</div>
                        <div class="data-value">
                          {{ training.created_at | formatDate }} hour
                        </div>
                      </div>
                    </li>
                    <li class="data-item">
                      <div class="data-col">
                        <div class="data-label">Benötigte Ränge</div>
                        <div class="data-value">
                          <span
                            class="badge badge-info badge-dim badge-sm"
                            v-for="role in training.roles"
                            >{{ role.name }}</span
                          >
                        </div>
                      </div>
                    </li>
                    <li class="data-item">
                      <div class="data-col">
                        <div class="data-label">
                          Folgende Themen werden in der Ausbildung bearbeitet:
                        </div>
                        <div class="data-value" v-html="training.text"></div>
                      </div>
                    </li>
                  </ul>
                </div>
                <!-- .card -->
              </div>
              <!-- .col -->
              <div class="col-lg-12" v-can="'trainings.manage'">
                <div class="card">
                  <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Rank</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="user in training.users"
                        v-if="training.users.length > 0"
                      >
                        <td>{{ user.name }}</td>
                        <td>{{ user.roles[0].name }}</td>
                        <td>
                          <div class="btn-group">
                            <a
                              href=""
                              class="btn btn-outline-primary"
                              data-toggle="modal"
                              data-target="#editModal"
                              @click.prevent="
                                setValues(user.name, user.slug, training.slug)
                              "
                              ><em class="ni ni-pen"></em
                            ></a>
                            <a
                              href=""
                              class="btn btn-outline-danger"
                              @click.prevent="
                                removeUser(training.slug, user.slug)
                              "
                              ><em class="ni ni-trash"></em
                            ></a>
                          </div>
                        </td>
                      </tr>
                      <tr v-if="training.users.length == 0">
                        <td colspan="3">
                          <span
                            class="badge badge-dim badge-sm badge-outline-danger"
                            >So far no officers have registered for the training
                            registered.</span
                          >
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- .col -->
            </div>
            <!-- .row -->
          </div>
          <!-- .nk-block -->
        </div>
      </div>
    </div>
    <!-- Modal Content Code -->
    <div class="modal fade" tabindex="-1" id="editModal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <a href="#" class="close" data-dismiss="modal" aria-label="Close">
            <em class="icon ni ni-cross"></em>
          </a>
          <div class="modal-header">
            <h5 class="modal-title">Change status of {{ modal.name }}</h5>
          </div>
          <div class="modal-body">
            <p>
              Here you can set the status of the officer, provided that he has completed the
              training successfully/unsuccessfully completed.
            </p>
            <form @submit.prevent="statusUpdate">
              <div class="form-group">
                <label for="" class="required">Set status</label>
                <select v-model="modal.status" class="form-control">
                  <option value="">-- Please select --</option>
                  <option value="approved">Completed</option>
                  <option value="denied">Failed</option>
                </select>
              </div>
              <div class="form-group">
                <button
                  type="submit"
                  class="btn btn-outline-primary btn-block text-center"
                >
                  Submit
                </button>
              </div>
            </form>
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
      training: {},
      modal: {
        name: "Test",
        user_id: "",
        training_id: "",
        status: "",
      },
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      axios
        .get("/ausbildungen/" + this.$route.params.slug + "/daten")
        .then((response) => {
          this.training = response.data.training;
        });
    },
    removeUser(training, user) {
      axios
        .post("/ausbildung/" + training + "/officer/" + user + "/löschen")
        .then((response) => {
          this.$noty.success(
            "You have " +
              response.data.name +
              " successfully deleted from the training."
          );
          this.getData();
        });
    },
    setValues(name, id, training) {
      this.modal.name = name;
      this.modal.user_id = id;
      this.modal.training_id = training;
    },
    statusUpdate() {
      axios
        .post("/ausbildungen/" + this.modal.training_id + "/status/ändern", {
          user: this.modal.user_id,
          status: this.modal.status,
        })
        .then((response) => {
          this.$hideModal("editModal");
          this.$noty.success(
            "You have the status of the officer " +
              response.data.name +
              " successfully set!"
          );
          this.getData();
        });
    },
    applyTraining(training) {
      axios.post("/ausbildung/" + training + "/teilnehmen").then((response) => {
        if (response.data.success) {
          this.$noty.success("You have successfully enrolled in the training");
        } else {
          this.$noty.error("Error!");
        }
        this.getData();
      });
    },
    toggleStatus(id) {
        axios.post('/ausbildung/'+id+'/status')
            .then((response) => {
                this.$noty.success("You have successfully changed the status of the training.")
                this.getData()
            })
    }
  },
};
</script>
