<template>
  <div class="nk-content" ref="loadingContainer">
    <div class="container-fluid">
      <div class="nk-content-inner">
        <div class="nk-content-body">
          <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
              <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                  Create file entry
                </h3>
                <div class="nk-block-des text-soft">
                  <p>Create a new file entry.</p>
                </div>
              </div>
              <!-- .nk-block-head-content -->
              <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                  <a
                    href="#"
                    class="btn btn-icon btn-trigger toggle-expand mr-n1"
                    data-target="pageMenu"
                    ><em class="icon ni ni-more-v"></em
                  ></a>
                  <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                      <li class="nk-block-tools-opt">
                        <router-link class="btn btn-primary"
                          ><em class="icon ni ni-reports"></em
                          ><span>Back</span></router-link
                        >
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- .nk-block-head-content -->
            </div>
            <!-- .nk-block-between -->
          </div>
          <!-- .nk-block-head -->
          <div class="nk-block">
            <div class="card card-bordered card-stretch">
              <div class="card-inner-group">
                <div class="card-inner position-relative card-tools-toggle">
                  <h5 class="text-center mb-3">General information</h5>
                  <form @submit.prevent="">
                    <div class="form-group row">
                      <label for="" class="col-lg-3 text-right pt-1 required"
                        >Description</label
                      >
                      <div class="col-lg-6">
                        <editor
                          api-key="tn358sfioe89ot9qbxg208aa4ev92i3qb3tpgmbctdti7wkr"
                          :init="{
                            height: 300,
                            menubar: false,
                            plugins: [],
                            toolbar:
                              'undo redo | formatselect | bold italic backcolor | \
           alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | removeformat | help',
                            content_style: 'body { color: white }',
                          }"
                          v-model="createForm.text"
                        />
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-lg-3 text-right pt-1 required">Status</label>
                        <div class="col-lg-6">
                            <select v-model="createForm.status" class="form-control">
                                <option value="" disabled selected>-- Please select --</option>
                                <option value="0">Closed</option>
                                <option value="1">Open</option>
                                <option value="2">Bolo</option>
                            </select>
                        </div>
                    </div>
                    <h4 class="text-center mb-3">
                      What crimes were committed?
                      <a href="" data-toggle="modal" data-target="#penalties"
                        ><em class="ni ni-info text-primary"></em
                      ></a>
                    </h4>
                    <div v-bind:key="penalty.id" v-for="penalty in penalties">
                      <h5 class="text-center mb-3">{{ penalty.label }}</h5>
                      <table class="table table-tranx">
                        <thead>
                          <tr class="tb-tnx-head">
                            <th class="tb-tnx-id">
                              <span class="">Paragraph</span>
                            </th>
                            <th class="tb-tnx-info">
                              <span
                                class="tb-tnx-desc d-none d-sm-inline-block"
                              >
                                <span>Crime</span>
                              </span>
                              <span
                                class="tb-tnx-date d-md-inline-block d-none"
                              >
                                <span class="d-md-none">Date</span>
                                <span class="d-none d-md-block">
                                  <span>Imprisonment</span>
                                  <span>Fine</span>
                                </span>
                              </span>
                            </th>
                            <th class="tb-tnx-amount is-alt">
                              <span class="tb-tnx-total">Comment</span>
                            </th>
                            <th class="tb-tnx-action">
                              <span>#</span>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            class="tb-tnx-item"
                            v-for="children in penalty.children"
                            v-bind:key="children.id"
                            v-if="penalty.children.length > 0"
                          >
                            <td class="tb-tnx-id">
                              <span>{{ children.paragraph }}</span>
                            </td>
                            <td class="tb-tnx-info">
                              <div class="tb-tnx-desc">
                                <span class="title">{{ children.label }}</span>
                              </div>
                              <div class="tb-tnx-date">
                                <span class="date">{{
                                  children.imprisonment
                                }}</span>
                                <span class="date"
                                  >${{ children.fine | formatNumber }}</span
                                >
                              </div>
                            </td>
                            <td class="tb-tnx-amount is-alt">
                              <div class="tb-tnx-total">
                                <span
                                  class="amount"
                                  v-html="children.additional"
                                ></span>
                              </div>
                            </td>
                            <td>
                              <input
                                type="checkbox"
                                :value="children.id"
                                v-model="createForm.penalties"
                              />
                            </td>
                          </tr>
                          <tr v-else>
                            <td colspan="4">
                              No crimes have been created yet!
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div
                      class="form-group mt-4 position-sticky fixed-bottom card card-body"
                    >
                      <div class="col-lg-12 text-center">
                        <button @click.prevent="createEntry"
                          class="btn btn-primary col-lg-4 text-center btn-block"
                        >
                          Submit
                        </button>
                      </div>
                    </div>
                  </form>
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
    <div class="modal fade" tabindex="-1" id="penalties">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <a href="#" class="close" data-dismiss="modal" aria-label="Close">
            <em class="icon ni ni-cross"></em>
          </a>
          <div class="modal-header">
            <h5 class="modal-title">What crimes were committed?</h5>
          </div>
          <div class="modal-body">
            <p>
              Please tick all the criminal offenses that the citizen has
              has violated. The aggregation of detention units and/or
              fines will be automatically determined and displayed to you
              this form.
            </p>
          </div>
          <div class="modal-footer bg-light">
            <span class="sub-text"
              >We wish a lot of fun with the police system v2</span
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
      penalties: {},
      createForm: new Form({
        text: "",
        penalties: [],
        status: '',
      }),
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      axios.get("/einwohnerdatenbank/eintrag/erstellen").then((response) => {
        this.penalties = response.data.penalties;
      });
    },
    createEntry() {
      this.createForm
        .post(
          "/einwohnerdatenbank/" +
            this.$route.params.identifier +
            "/eintrag/erstellen"
        )
        .then((response) => {
          this.$router.push({
            name: "civilian-show",
            params: { identifier: this.$route.params.identifier },
          });
          this.$noty.success("You have successfully created the file entry!");
          this.$noty.info(
            "The fine amounts to $" +
              response.data.fine +
              " and the prison sentence to " +
              response.data.imprisonment +
              " Months.",
            { timeout: 25000 }
          );
        });
    },
  },
};
</script>

<style scoped>
</style>
