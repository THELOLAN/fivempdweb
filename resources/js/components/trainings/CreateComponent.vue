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
                          :to="{ name: 'trainings-index' }"
                          href="#"
                          class="btn btn-primary"
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
            <div class="card">
              <div class="card-body">
                <form @submit.prevent="postForm">
                  <div class="form-group row">
                    <label for="" class="control-label col-lg-2 text-right mt-1"
                      >Training title</label
                    >
                    <div class="col-lg-8">
                      <input
                        v-model="form.title"
                        :class="{ 'is-invalid': form.errors.has('title') }"
                        type="text"
                        class="form-control"
                      />
                      <has-error :form="form" field="title" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="control-label col-lg-2 text-right mt-1"
                      >Required rank</label
                    >
                    <div class="col-lg-8">
                      <multiselect
                        :options="roles"
                        v-model="form.roles"
                        label="name"
                        multiple
                      ></multiselect>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="" class="control-label col-lg-2 text-right mt-1"
                      >Description</label
                    >
                    <div class="col-lg-8">
                      <editor
                        :class="{ 'is-invalid': form.errors.has('text') }"
                        api-key="tn358sfioe89ot9qbxg208aa4ev92i3qb3tpgmbctdti7wkr"
                        :init="{
                          height: 200,
                          menubar: false,
                          plugins: [],
                          toolbar:
                            'undo redo | formatselect | bold italic backcolor | \
           alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | removeformat | help',
                          content_style: 'body { color: white }',
                        }"
                        v-model="form.text"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-lg-12 text-center">
                      <button
                        class="btn btn-secondary col-lg-4 btn-block text-center"
                      >
                        Submit
                      </button>
                    </div>
                  </div>
                </form>
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
      roles: {},
      form: new Form({
        title: "",
        roles: "",
        text: "",
      }),
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      axios.get("/ausbildungen/daten").then((response) => {
        this.roles = response.data.roles;
        this.form.title = response.data.training.title;
        this.form.roles = response.data.training.roles.id;
        this.form.text = response.data.training.text;
      });
    },
    postForm() {
        this.form.post('/ausbildung/erstellen').then((response) => {
            this.$noty.success("You have successfully created the training.");
        })
    }
  },
};
</script>
