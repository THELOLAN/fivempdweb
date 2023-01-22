<template>
  <div class="nk-content">
    <div class="container-fluid">
      <div class="nk-content-inner">
        <div class="nk-content-body">
          <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
              <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Trainings</h3>
                <div class="nk-block-des text-soft">
                  <p>
                    Available trainings are entered here and you
                    can sign up for them.
                  </p>
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
                      <li class="nk-block-tools-opt" v-can="'trainings.create'">
                        <router-link
                          :to="{ name: 'trainings-create' }"
                          href="#"
                          class="btn btn-primary"
                          ><em class="icon ni ni-plus"></em
                          ><span>Create training</span></router-link
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
                v-for="training in trainings"
              >
                <div class="card card-bordered h-100">
                  <div class="card-inner">
                    <div class="project">
                      <div class="project-head">
                        <a href="html/apps-kanban.html" class="project-title">
                          <div class="user-avatar sq bg-purple">
                            <span>DD</span>
                          </div>
                          <div class="project-info">
                            <h6 class="title">{{ training.title }}</h6>
                            <span class="sub-text">
                              <span
                                class="badge badge-dot badge-success"
                                v-if="training.status == 'active'"
                                >Open</span
                              >
                              <span class="badge badge-dot badge-danger" v-else
                                >Closed</span
                              >
                            </span>
                          </div>
                        </a>
                        <div class="drodown">
                          <a
                            href="#"
                            class="dropdown-toggle btn btn-sm btn-icon btn-trigger mt-n1 mr-n1"
                            data-toggle="dropdown"
                            ><em class="icon ni ni-more-h"></em
                          ></a>
                          <div class="dropdown-menu dropdown-menu-right">
                            <ul class="link-list-opt no-bdr">
                              <li>
                                <router-link
                                  :to="{
                                    name: 'trainings-show',
                                    params: { slug: training.slug },
                                  }"
                                  href="#"
                                  ><em class="icon ni ni-eye"></em
                                  ><span
                                    >Ausbildung anschauen</span
                                  ></router-link
                                >
                              </li>
                              <li v-can="'trainings.delete'">
                                <a
                                  @click.prevent="removeTraining(training.slug)"
                                  href=""
                                  ><em class="icon ni ni-trash"></em> Delete training</a
                                >
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="project-details">
                        <p>
                          Öffne diese Ausbildung, um mehr Informationen zu
                          erhalten.
                        </p>
                      </div>
                      <hr class="text-muted" v-if="training.users.length > 0" />
                      <p v-if="training.users.length > 0">
                        The following officers are participating in the training:
                      </p>
                      <div
                        class="project-meta"
                        v-if="training.users.length > 0"
                      >
                        <ul class="project-users g-1">
                          <li v-for="user in training.users.slice(0, 2)">
                            <div
                              class="user-avatar sm bg-primary"
                              data-toggle="tooltip"
                              data-placement="top"
                              :title="user.name"
                            >
                              <span>{{ user.name.charAt(0) }}</span>
                            </div>
                          </li>
                          <li>
                            <div
                              class="user-avatar bg-light sm"
                              v-if="training.users.length > 2"
                            >
                              <span>+{{ training.users.length - 2 }}</span>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- .nk-block -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      trainings: {},
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      axios.get("/ausbildungen/daten").then((response) => {
        this.trainings = response.data.trainings;
      });
    },
    removeTraining(id) {
      axios.post("/ausbildung/" + id + "/löschen").then((response) => {
        this.$noty.success("You have successfully cleared the training.");
        this.getData();
      });
    },
  },
};
</script>
