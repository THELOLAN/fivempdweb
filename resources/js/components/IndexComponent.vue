<template>
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Dashboard</h3>
                                <div class="nk-block-des text-soft">
                                    <p>Welcome to the police system of the LSPD.</p>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-xxl-12">
                                <div class="row g-gs">
                                    <div class="col-lg-12 col-xxl-12">
                                        <div class="row g-gs">
                                            <div class="col-sm-6 col-lg-12 col-xxl-6">
                                                <div class="card card-bordered">
                                                    <div class="card-inner">
                                                        <div class="card-title-group align-start mb-2">
                                                            <div class="card-title">
                                                                <h6 class="title">Citizen count</h6>
                                                            </div>
                                                        </div>
                                                        <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                            <div class="nk-sale-data">
                                                                <span class="amount">{{ data.civilians }}</span>
                                                            </div>
                                                            <div class="nk-sales-ck">
                                                                <canvas class="sales-bar-chart" id="activeSubscription"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- .card -->
                                            </div><!-- .col -->
                                            <div class="col-sm-6 col-lg-12 col-xxl-6">
                                                <div class="card card-bordered">
                                                    <div class="card-inner">
                                                        <div class="card-title-group align-start mb-2">
                                                            <div class="card-title">
                                                                <h6 class="title">Vehicle count</h6>
                                                            </div>
                                                        </div>
                                                        <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                            <div class="nk-sale-data">
                                                                <span class="amount">{{ data.vehicles }}</span>
                                                            </div>
                                                            <div class="nk-sales-ck">
                                                                <canvas class="sales-bar-chart" id="totalSubscription"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- .card -->
                                            </div><!-- .col -->
                                        </div><!-- .row -->
                                    </div><!-- .col -->
                                    <div class="col-lg-12 col-xxl-12">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <div class="card-title-group align-start mb-2">
                                                    <div class="card-title">
                                                        <h6 class="title">Created file entries</h6>
                                                        <p>In the last 30 days, all file entries created</p>
                                                    </div>
                                                </div>
                                                <div class="align-end gy-3 gx-5 flex-wrap flex-md-nowrap flex-lg-wrap flex-xxl-nowrap">
                                                    <div class="nk-sale-data-group flex-md-nowrap g-4">
                                                        <div class="nk-sale-data">
                                                            <span class="amount">{{ data.entries_week }} </span>
                                                            <span class="sub-title">This week</span>
                                                        </div>
                                                        <div class="nk-sale-data">
                                                            <span class="amount">{{ data.entries_month }}</span>
                                                            <span class="sub-title">This month</span>
                                                        </div>
                                                    </div>
                                                    <div class="nk-sales-ck sales-revenue">
                                                        <canvas class="sales-bar-chart" id="salesRevenue"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .col -->
                                </div><!-- .row -->
                            </div><!-- .col -->
                            <div class="col-xxl-12">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title"><span class="mr-2">Last file entries</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-inner p-0 border-top">
                                        <div class="nk-tb-list nk-tb-orders">
                                            <div class="nk-tb-item nk-tb-head">
                                                <div class="nk-tb-col"><span>File number</span></div>
                                                <div class="nk-tb-col tb-col-sm"><span>Criminal</span></div>
                                                <div class="nk-tb-col tb-col-md"><span>Date</span></div>
                                                <div class="nk-tb-col tb-col-lg"><span>Officer concerned</span></div>
                                                <div class="nk-tb-col"><span>Fine</span></div>
                                                <div class="nk-tb-col"><span class="d-none d-sm-inline">Imprisonment</span></div>
                                            </div>
                                            <div class="nk-tb-item" v-for="entries in data.civilian_entries">
                                                <div class="nk-tb-col">
                                                    <span class="tb-lead"><router-link :to="{ name: 'civilian-show', params: { identifier: entries.civilian.identifier } }" href="#">#{{entries.reference}}</router-link></span>
                                                </div>
                                                <div class="nk-tb-col tb-col-sm">
                                                    <div class="user-card">
                                                        <div class="user-avatar user-avatar-sm bg-purple">
                                                            <span>{{ entries.civilian.firstname.charAt(0) }}{{ entries.civilian.lastname.charAt(0) }}</span>
                                                        </div>
                                                        <div class="user-name">
                                                            <span class="tb-lead">{{ entries.civilian.firstname +' '+ entries.civilian.lastname }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-tb-col tb-col-md">
                                                    <span class="tb-sub">{{ entries.created_at | formatDate }}</span>
                                                </div>
                                                <div class="nk-tb-col tb-col-lg">
                                                    <span class="badge badge-info mr-1" v-for="user in entries.users">{{ user.name }}</span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span class="tb-sub tb-amount">{{ entries.fine | formatNumber }} <span>USD</span></span>
                                                </div>
                                                <div class="nk-tb-col">
                                                    <span class="tb-sub tb-amount">{{ entries.imprisonment }} <span>MINUTES</span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card -->
                            </div><!-- .col -->
							<div class="col-xxl-12">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start gx-3 mb-3">
                                            <div class="card-title">
                                                <h6 class="title">Currently on duty:</h6>
                                                <p>Get visibility on all officers on duty.</p>
                                            </div>
                                        </div>
                                    </div>
									<div class="card-inner p-0" style="min-height: 800px;">
										<div class="nk-sales-ck large pt-4">
                                            <table class="table">
                                                <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Service number</th>
                                                    <th scope="col">Control center</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="user in data.users">
                                                    <td>{{ user.name }}</td>
                                                    <td>{{ user.username }}</td>
                                                    <td>
                                                        <span class="badge badge-success" v-if="user.leitstelle">Yes</span>
                                                        <span class="badge badge-danger" v-else>No</span>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>
									</div>
                                </div><!-- .card -->
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            data: {}
        }
    },
    mounted() {
        this.getData()
    },
    methods: {
        getData() {
            axios.get('/dashboard')
                .then((response) => {
                    this.data = response.data;
                })
        }
    }
}
</script>

<style scoped>

</style>
