<template>
  <div class="nk-content">
    <div class="container-fluid">
      <div class="nk-content-inner">
        <div class="nk-content-body">
          <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
              <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Investigations</h3>
                <div class="nk-block-des text-soft">
                  <p>
                    Create a new investigation to stop the criminals.
                    the criminals.
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
                      <li>
                        <router-link
                          :to="{ name: 'investigations-index' }"
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
            <div class="card card-bordered card-stretch">
              <div class="card-inner-group">
                <div class="card-inner position-relative card-tools-toggle">
                  <form @submit.prevent="postData">
                      <div class="form-group row">
                      <label class="form-label col-lg-2 text-right mt-1"
                        >Title of the investigation</label
                      >
                      <div class="col-lg-6">
                        <input type="text" v-model="form.label" class="form-control">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="form-label col-lg-2 text-right mt-1"
                        >Officer involved</label
                      >
                      <div class="col-lg-6">
                        <multiselect :options="users" v-model="form.users" label="name" multiple="true"></multiselect>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="form-label col-lg-2 text-right mt-1"
                        >Suspects</label
                      >
                      <div class="col-lg-6">
                        <multiselect multiple="true" v-model="form.civilians" label="lastname" track-by="lastname" :show-labels="false" :custom-label="customLabel" :options="civilians">
                            <template slot="option" slot-scope="props">
                                <div class="option__desc"><span class="option__title">{{ props.option.firstname }}</span> <span class="option__small">{{ props.option.lastname }}</span></div>
                            </template>
                        </multiselect>
                        <small>Unfortunately, it is only possible to search by last name!</small>
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="form-label col-lg-2 text-right mt-1">Description</label>
                        <div class="col-lg-6">
                            <editor :class="{ 'is-invalid' : form.errors.has('text') }"
                                                    api-key="tn358sfioe89ot9qbxg208aa4ev92i3qb3tpgmbctdti7wkr"
                                                    :init="{
                                                height: 200,
                                                menubar: false,
                                                plugins: [],
                                                toolbar:
                                                  'undo redo | formatselect | bold italic backcolor | \
           alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | removeformat | help',
                                                  content_style: 'body { color: white }'
                                        }" v-model="form.text"
                                                />
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                      <button type="submit"
                        class="btn btn-outline-primary btn-block col-lg-3 text-center"
                      >
                        Submit
                      </button>
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
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
          users: '',
          civilians: '',
          text: '',
          label: '',
      }),
      civilians: {},
      users: {},
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      axios.get("/ermittlungen/daten").then((response) => {
        this.civilians = response.data.civilians;
        this.users = response.data.users;
      });
    },
    postData() {
      this.form.post("/ermittlungen/erstellen").then((response) => {
        //this.$router.push({ name: "investigations-index" });
        this.$noty.success(
          "You have successfully opened the investigation and it is now available under file number #" +
            response.data.reference +
            " to find."
        );
      });
    },
    customlabel({ firstname, lastname }) {
            return '${firstname} ${lastname}'
    }
  },
};
</script>
