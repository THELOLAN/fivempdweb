        <template>
  <div class="nk-content">
    <div class="container-fluid">
      <div class="nk-content-inner">
        <div class="nk-content-body">
          <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between g-3">
              <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">
                  Ermittlungsakte /
                  <strong class="text-primary small">{{
                    investigation.label
                  }}</strong>
                </h3>
                <div class="nk-block-des text-soft">
                  <ul class="list-inline">
                    <li>
                      File Number:
                      <span class="text-base">{{
                        investigation.reference
                      }}</span>
                    </li>
                    <li>
                      Status:
                      <span
                        class="badge badge-dot badge-success"
                        v-if="investigation.status == 'active'"
                        >Active</span
                      >
                      <span class="badge badge-dot badge-danger" v-else
                        >Closed</span
                      >
                    </li>
                  </ul>
                </div>
              </div>
              <div class="nk-block-head-content">
                <router-link
                  :to="{ name: 'investigations-index' }"
                  href=""
                  class="btn btn-outline-light bg-white d-none d-sm-inline-flex"
                  ><em class="icon ni ni-arrow-left"></em
                  ><span>Back</span></router-link
                >
              </div>
            </div>
          </div>
          <!-- .nk-block-head -->
          <div class="nk-block">
            <div class="card card-bordered">
              <div class="card-aside-wrap">
                <div class="card-content">
                  <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                    <li class="nav-item">
                      <a class="nav-link active"
                        ><em class="icon ni ni-user-circle"></em
                        ><span>Personal</span></a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link"
                        ><em class="icon ni ni-info"></em
                        ><span>Coming soon...</span></a
                      >
                    </li>
                    <li class="nav-item nav-item-trigger d-xxl-none">
                      <a
                        href="#"
                        class="toggle btn btn-icon btn-trigger"
                        data-target="userAside"
                        ><em class="icon ni ni-user-list-fill"></em
                      ></a>
                    </li>
                  </ul>
                  <!-- .nav-tabs -->
                  <div class="card-inner">
                    <div class="nk-block">
                      <div class="nk-block-head">
                        <h5 class="title">Allgemeine Informationen</h5>
                        <p>
                          The most important thing is the information to be able to
                          to be able to conclude an investigation.
                        </p>
                      </div>
                      <!-- .nk-block-head -->
                      <dl class="row">
                        <dt class="col-lg-2">Beteiligte Officer</dt>
                        <dd class="col-lg-10">
                          <span
                            class="badge badge-primary mr-1"
                            v-for="user in investigation.users"
                            >{{ user.name }}</span
                          >
                        </dd>
                      </dl>
                      <dl class="row">
                        <dt class="col-lg-2">Tatverdächtige</dt>
                        <dd class="col-lg-10">
                          <span
                            class="badge badge-primary mr-1"
                            v-for="user in investigation.civilians"
                            >{{ user.firstname+' '+user.lastname }}</span
                          >
                        </dd>
                      </dl>
                    </div>
                    <!-- .nk-block -->
                    <div class="nk-divider divider md"></div>
                    <div class="nk-block">
                      <div
                        class="nk-block-head nk-block-head-sm nk-block-between"
                      >
                        <h5 class="title">Investigation</h5>
                        <a
                          href="#"
                          data-toggle="modal"
                          data-target="#createEntry"
                          class="link link-sm"
                          v-can="'investigations.create.entry'"
                          >+ Eintrag hinzufügen</a
                        >
                      </div>
                      <!-- .nk-block-head -->
                      <div class="bq-note">
                        <div
                          class="bq-note-item"
                          v-for="entry in investigation.entries.reverse()"
                        >
                          <div class="bq-note-text" v-html="entry.text"></div>
                          <div class="bq-note-meta">
                            <span class="bq-note-added"
                              >Hinzugefügt am
                              <span class="date">{{
                                entry.created_at | formatDate
                              }}</span>
                              hour</span
                            >
                            <span class="bq-note-sep sep">|</span>
                            <span class="bq-note-by"
                              >von <span>{{ entry.user.name }}</span></span
                            >
                            <a
                              href="#"
                              class="link link-sm link-danger"
                              @click.prevent="removeEntry(entry.id)"
                              v-can="'investigations.delete.entry'"
                              >Delete entry</a
                            >
                          </div>
                        </div>
                        <!-- .bq-note-item -->
                        <div
                          v-if="investigation.entries.length == 0"
                          class="alert alert-warning alert-pro"
                        >
                          <em class="ni ni-info"></em> So far no
                          entries have been added for determination! Please investigate
                          further and then add an entry!
                        </div>
                      </div>
                      <!-- .bq-note -->
                    </div>
                    <!-- .nk-block -->
                  </div>
                  <!-- .card-inner -->
                </div>
                <!-- .card-content -->
                <div class="modal fade" tabindex="-1" id="createEntry">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <a
                        href="#"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                      >
                        <em class="icon ni ni-cross"></em>
                      </a>
                      <div class="modal-header">
                        <h5 class="modal-title">Create entry</h5>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="" class="text-right control-label pt-1 required"
                            >Text</label
                          >
                          <editor
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
                      <div class="modal-footer bg-light">
                        <a @click.prevent="postData(investigation.id)" href="" class="btn btn-outline-primary">Create</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- .card-aside-wrap -->
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
      investigation: {},
      form: new Form({
        text: "",
      }),
    };
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      axios
        .get("/ermittlungen/" + this.$route.params.id + "/daten")
        .then((response) => {
          this.investigation = response.data.investigation;
        });
    },
    postData(id) {
        this.form.post('/ermittlungen/'+id+'/eintrag/erstellen')
            .then((response) => {
                this.$noty.success("You have successfully created the entry!")
                this.getData()
                this.$hideModal('createEntry')
            })
    },
    removeEntry(id) {
        axios.post('/ermittlungen/eintrag/'+id+'/löschen')
            .then((response) => {
                this.getData()
                this.$noty.success('You have successfully deleted the entry!')
            })
    }
  },
};
</script>

        <style scoped>
</style>
