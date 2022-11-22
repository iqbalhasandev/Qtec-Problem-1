<template>
  <div>
    <div>
      <div class="card">
        <div
          class="card-header d-flex justify-content-between align-items-center"
        >
          <h5 class="mb-0">Filter</h5>
          <button
            class="btn btn-primary"
            type="button"
            data-bs-toggle="collapse"
            aria-expanded="false"
            aria-controls="collapseExample"
            data-bs-target="#filterCollapse"
          >
            <b>Click</b>
          </button>
        </div>
        <div class="collapse" id="filterCollapse">
          <div class="card-body">
            <div>
              <h6 class="pl-3 mb-1">All Keywords:</h6>
              <label
                v-for="(keyword, index) in filters.keywords"
                :key="index"
                :for="keyword + index"
                class="keyword-style my-1 mx-2"
              >
                <input
                  type="checkbox"
                  :id="keyword + index"
                  v-model="keywords"
                  :value="keyword.search_term"
                />&nbsp;{{ keyword.search_term }} ({{ keyword.count }} times
                found)
              </label>
            </div>
            <div class="pt-2">
              <h6 class="pl-3 mb-1">All Users:</h6>
              <label
                v-for="(user, index) in filters.users"
                :key="index"
                :for="'user' + index"
                class="keyword-style my-1 mx-2"
              >
                <input
                  type="checkbox"
                  :id="'user' + index"
                  v-model="users"
                  :value="user.id"
                />&nbsp;{{ user.name }}
              </label>
            </div>
            <div class="pt-2">
              <h6 class="pl-3 mb-1">Time Range:</h6>
              <label for="time_today" class="keyword-style my-1 mx-2"
                ><input
                  type="checkbox"
                  id="time_today"
                  v-model="dateRange"
                  value="today"
                />&nbsp;Today</label
              >
              <label for="time_yesterday" class="keyword-style my-1 mx-2"
                ><input
                  type="checkbox"
                  id="time_yesterday"
                  v-model="dateRange"
                  value="yesterday"
                />&nbsp;Yesterday</label
              >
              <label for="time_last_week" class="keyword-style my-1 mx-2">
                <input
                  type="checkbox"
                  id="time_last_week"
                  value="last_week"
                  v-model="dateRange"
                />&nbsp;Last Week</label
              >
              <label for="time_last_month" class="keyword-style my-1 mx-2"
                ><input
                  type="checkbox"
                  id="time_last_month"
                  value="last_month"
                  v-model="dateRange"
                />&nbsp;Last Month</label
              >
            </div>
            <div class="pt-2">
              <h6 class="pl-3 mb-1">Select Date:</h6>
              <div class="row">
                <div class="col-md-6">
                  <label for="from_date">Start Date</label>
                  <input
                    type="date"
                    class="form-control"
                    id="from_date"
                    name="from_date"
                    v-model="startDate"
                    :min="endDate"
                  />
                </div>
                <div class="col-md-6">
                  <label for="to_date">End Date</label>
                  <input
                    type="date"
                    class="form-control"
                    id="to_date"
                    name="to_date"
                    v-model="endDate"
                    :max="startDate"
                  />
                </div>
              </div>
            </div>
            <div class="text-center pt-2">
              <button
                type="button"
                class="btn btn-primary mt-2"
                @click="getActivities"
              >
                Apply Filter
              </button>
              <button
                type="button"
                class="btn btn-danger mt-2 mx-2"
                @click="reset"
              >
                Reset
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th>Search Term</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(activity, index) in activities" :key="index">
            <td>{{ activity.search_term }}</td>
            <td>{{ activity.results_count }}</td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      activities: [],
      filters: {
        keywords: [],
        users: [],
        time_range: [],
        date_range: [],
      },

      keywords: [],
      users: [],
      dateRange: [],
      startDate: null,
      endDate: null,
    };
  },
  mounted() {
    console.log("Component mounted.");
    this.getActivities();
    this.getFilters();
  },
  methods: {
    reset() {
      this.keywords = [];
      this.users = [];
      this.dateRange = [];
      this.startDate = null;
      this.endDate = null;
      this.getActivities();
    },
    getActivities() {
      axios
        .get("/search-activity/get-activities", {
          params: {
            keywords: this.keywords,
            users: this.users,
            date_range: this.dateRange,
            start_date: this.startDate,
            end_date: this.endDate,
          },
        })
        .then((res) => {
          this.activities = res.data;
        })
        .catch((err) => {
          console.error(err);
        });
    },

    getFilters() {
      axios.get("/search-activity/get-filters").then((response) => {
        this.filters = response.data;
      });
    },
  },
  watch: {
    keywords: function (newVal, oldVal) {
      this.getActivities();
    },
    users: function (newVal, oldVal) {
      this.getActivities();
    },
    dateRange: function (newVal, oldVal) {
      this.getActivities();
    },
    startDate: function (newVal, oldVal) {
      this.getActivities();
    },
    endDate: function (newVal, oldVal) {
      this.getActivities();
    },
  },
};
</script>
